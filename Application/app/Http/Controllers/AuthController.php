<?php

namespace App\Http\Controllers;

use App\Models\MsUser;
use App\Models\PendingRegistration;
use App\Models\TrOtp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registerForm()
    {
        $title = "Registrasi FingerPay";
        $content = view('auth.regis');
        return view('auth.template.template', compact('title', 'content'));
    }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'nickname' => 'required',
            'email' => 'required|email|unique:msuser,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $otp = rand(100000, 999999);

        PendingRegistration::create([
            'usernm' => $request->nickname,
            'email' => $request->email,
            'pswd' => Hash::make($request->password),
            'otp' => $otp,
            'isactive' => 1,
            'createddate' => now(),
            'createdby' => 1,
        ]);

        session([
            'pending_email' => $request->email,
            'pending_otp' => now()->timestamp
        ]);

        Mail::raw("Berikut kode OTP Anda: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('OTP Verification FingerPay');
        });
        return response()->json([
            'msg' => 'Registrasi berhasil! Silakan cek email Anda untuk kode OTP.',
            'redirect' => route('otpForm'),
        ]);
    }

    public function otpForm()
    {
        $title = "Verifikasi OTP FingerPay";
        $content = view('auth.otp');
        return view('auth.template.template', compact('title', 'content'));
    }

    public function otpProcess(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = session('pending_email');
        if (!$email) {
            return response()->json(['msg' => 'Session tidak valid'], 422);
        }

        $pending = PendingRegistration::where('email', $email)
            ->where('isactive', 1)
            ->first();

        if (!$pending) {
            return response()->json(['msg' => 'Data tidak ditemukan'], 404);
        }

        if (now()->diffInMinutes($pending->createddate) > 5) {
            $pending->update(['isactive' => 0]);
            session()->forget('pending_email', 'pending_otp');
            return response()->json(['msg' => 'OTP telah kedaluwarsa'], 422);
        }

        if (trim((string) $pending->otp) !== trim((string) $request->otp)) {
            return response()->json(['msg' => 'OTP tidak valid'], 422);
        }
        Log::info('OTP DEBUG', [
            'db' => $pending->otp,
            'input' => $request->otp,
        ]);

        MsUser::create([
            'usernm' => $pending->usernm,
            'email' => $pending->email,
            'pswd' => $pending->pswd,
            'roleid' => 3,
            'isactive' => 1,
            'createddate' => now(),
            'createdby' => 1,
        ]);

        $pending->update(['isactive' => 0]);
        session()->forget('pending_email', 'pending_otp');
        return response()->json([
            'msg' => 'Verifikasi OTP berhasil! Silakan login.',
            'redirect' => route('loginForm'),
        ]);
    }

    public function otpResend()
    {
        $email = session('pending_email');
        $lastsend = session('pending_otp');
        if (!$email || !$lastsend || now()->diffInSeconds($lastsend) < 60) {
            return response()->json(['error' => 'Permintaan terlalu sering'], 429);
        }

        if (now()->timestamp - $lastsend < 300) {
            return response()->json([
                'msg' => 'OTP masih berlaku, silakan cek email Anda',
            ], 429);
            $pendingUser = session('pending_user');

            if (!$pendingUser) {
                return response()->json(['error' => 'Session tidak valid'], 400);
            }

            $otp = rand(100000, 999999);

            PendingRegistration::where('email', $email)
                ->where('isactive', 1)
                ->update(['otp' => $otp, 'updateddate' => now()]);

            session(['pending_otp' => now()->timestamp]);

            Mail::raw("Berikut kode OTP baru Anda: $otp", function ($message) use ($pendingUser) {
                $message->to($pendingUser['email'])
                    ->subject('OTP Verification FingerPay - Resend');
            });

            return response()->json(['success' => true, 'msg' => 'OTP berhasil dikirim ulang']);
        }
    }

    public function loginForm()
    {
        $title = "Login FingerPay";
        $content = view('auth.login');
        return view('auth.template.template', compact('title', 'content'));
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'nickname' => 'required',
            'password' => 'required',
        ]);

        $user = MsUser::where('usernm', $request->nickname)
            ->where('isactive', 1)
            ->first();

        if (!$user || !Hash::check($request->password, $user->pswd)) {
            return response()->json([
                'msg' => 'Username atau password salah'
            ], 422);
        }
        session([
            'userid' => $user->userid,
            'roleid' => $user->roleid,
            'usernm' => $user->usernm,
        ]);

        $redirect = match ($user->roleid) {
            1 => route('admin_dashboard'),
            2 => route('penjual_dashboard'),
            default => route('user_dashboard'),
        };
        return response()->json([
            'msg' => 'Login berhasil',
            'redirect' => $redirect,
        ]);
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('loginForm');
    }
}
