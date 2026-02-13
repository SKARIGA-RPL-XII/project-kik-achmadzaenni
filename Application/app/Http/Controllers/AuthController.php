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
        $request->validate(
            [
                'usernm' => 'required|unique:msuser,usernm',
                'email' => 'required|email|unique:msuser,email',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'usernm.required' => 'Nickname harus diisi',
                'usernm.unique' => 'Nickname sudah terdaftar',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.confirmed' => 'KOnfirmasi password dahulu',
            ]

        );

        PendingRegistration::where('email', $request->email)->delete();

        $pending = PendingRegistration::create([
            'usernm' => $request->usernm,
            'email' => $request->email,
            'pswd' => Hash::make($request->password),
            'isactive' => 1,
            'createddate' => now(),
            'createdby' => 1,
        ]);

        $otp = rand(100000, 999999);

        TrOtp::where('userid', $pending->pendingid)->delete();

        TrOtp::create([
            'userid' => $pending->pendingid,
            'otp' => $otp,
            'isactive' => 1,
            'createdby' => 1,
        ]);
        session([
            'pendingid' => $pending->pendingid,
            'pending_otp' => now()
        ]);

        $username = $request->usernm;
        $emailContent = <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: Arial, sans-serif;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="padding: 20px 0; text-align: center;">
                    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        
                        <div style="background-color: #2E973E; padding: 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: bold;">FingerPay</h1>
                            <p style="color: #e6fffa; margin: 5px 0 0; font-size: 14px;">Verifikasi Keamanan</p>
                        </div>

                        <div style="padding: 40px 30px; text-align: center; color: #333333;">
                            <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 10px; color: #111827;">Halo, $username</h2>
                            <p style="font-size: 15px; line-height: 1.6; color: #4b5563; margin-bottom: 25px;">
                                Terima kasih telah mendaftar. Untuk melanjutkan, silakan masukkan kode verifikasi (OTP) berikut ke dalam aplikasi:
                            </p>

                            <div style="background-color: #f0fdf4; border: 2px dashed #2E973E; border-radius: 12px; padding: 20px; margin: 0 auto 25px; display: inline-block;">
                                <span style="font-size: 32px; font-weight: 800; letter-spacing: 5px; color: #2E973E; display: block;">
                                    $otp
                                </span>
                            </div>

                            <p style="font-size: 13px; color: #6b7280; margin-top: 10px;">
                                <strong style="color: #ef4444;">Penting:</strong> Kode ini berlaku selama 5 menit. Jangan berikan kode ini kepada siapapun.
                            </p>
                        </div>

                        <div style="background-color: #f9fafb; padding: 20px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="font-size: 12px; color: #9ca3af; margin: 0;">&copy; 2026 FingerPay System. All rights reserved.</p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </body>
    </html>
    HTML;

        Mail::html($emailContent, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Kode OTP Verifikasi FingerPay');
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


        $pendingid = session('pendingid');
        if (!$pendingid) {
            return response()->json(['msg' => 'Session tidak valid'], 422);
        }
        $pending = PendingRegistration::find($pendingid);
        if (!$pending) {
            return response()->json(['msg' => 'Data tidak ditemukan'], 404);
        }

        $otpData = TrOtp::where('userid', $pendingid)
            ->where('isactive', 1)
            ->first();

        if (!$otpData) {
            return response()->json(['msg' => 'OTP tidak ditemukan'], 422);
        }
        if (now()->diffInMinutes($otpData->createddate) > 5) {
            $pending->update(['isactive' => 0]);
            $pending->delete();
            session()->forget('pendingid', 'pending_otp');
            return response()->json(['msg' => 'OTP telah kedaluwarsa'], 422);
        }

        if ($otpData->otp != $request->otp) {
            return response()->json(['msg' => 'OTP tidak valid'], 422);
        }

        $otpid = $otpData->otpid;
        MsUser::create([
            'usernm' => $pending->usernm,
            'email' => $pending->email,
            'pswd' => $pending->pswd,
            'roleid' => 3,
            'isactive' => 1,
            'createddate' => now(),
            'createdby' => 1,
        ]);

        TrOtp::where('otpid', $otpid)->delete();
        $pending->update(['isactive' => 0]);
        $pending->delete();
        session()->forget('pendingid', 'pending_otp');
        return response()->json([
            'msg' => 'Verifikasi OTP berhasil! Silakan login.',
            'redirect' => route('loginForm'),
        ]);
    }

    public function otpResend()
    {
        $pendingid = session('pendingid');
        $lastsend = session('pending_otp');

        if (!$pendingid || !$lastsend || now()->diffInSeconds($lastsend) < 60) {
            return response()->json(['msg' => 'Permintaan terlalu sering'], 429);
        }

        if (now()->diffInSeconds($lastsend) < 60) {
            return response()->json([
                'msg' => 'OTP masih berlaku, silakan cek email Anda',
            ], 429);

            $otpData = TrOtp::where('userid', $pendingid)
                ->where('isactive', 1)
                ->first();

            if ($otpData && now()->diffInMinutes($otpData->createddate) < 5) {
                return response()->json([
                    'msg' => 'OTP masih berlaku, silakan cek email Anda',
                ], 429);
            }
            $otp = rand(100000, 999999);

            TrOtp::updateOrCreate(
                ['userid' => $pendingid],
                [
                    'otp' => $otp,
                    'createddate' => now(),
                    'createdby' => 1,
                ]
            );

            session(['pending_otp' => now()]);

            $pending = PendingRegistration::find($pendingid);
            Mail::raw("Berikut kode OTP baru Anda: $otp", function ($message) use ($pending) {
                $message->to($pending->email)
                    ->subject('OTP Verification FingerPay');
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
            'usernm' => 'required',
            'password' => 'required',
        ]);

        $user = MsUser::where('usernm', $request->usernm)
            ->where('isactive', 1)
            ->first();

        if (!$user) {
            return response()->json([
                'msg' => 'Username salah'
            ], 422);
        }
        if (!Hash::check($request->password, $user->pswd)) {
            return response()->json([
                'msg' => 'Password salah'
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
        return response()->json([
            'msg' => 'Logout Berhasil',
            'redirect' => route('loginForm')
        ]);
    }
}
