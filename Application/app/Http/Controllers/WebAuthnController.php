<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laragear\WebAuthn\Facades\WebAuthn;
use Illuminate\Support\Facades\Auth;

class WebAuthnController extends Controller
{
    public function registerOptions(Request $request)
    {
        return WebAuthn::registerOptions()->toResponse($request);
    }

    public function registerProcess(Request $request)
    {
        try {
            WebAuthn::processRegistration($request);
            return response()->json(['msg' => 'Sidik jari berhasil didaftarkan!']);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Gagal mendaftarkan: ' . $e->getMessage()], 422);
        }
    }

    public function loginOptions(Request $request)
    {
        return WebAuthn::loginOptions()->toResponse($request);
    }

    public function loginProcess(Request $request)
    {
        try {
            WebAuthn::processLogin($request);
            return response()->json(['msg' => 'Verifikasi Biometrik Berhasil!']);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Verifikasi Gagal: ' . $e->getMessage()], 422);
        }
    }

    public function destroy($id)
    {
        $credential = Auth::user()->webAuthnCredentials()->findOrFail($id);
        $credential->delete();

        return response()->json(['msg' => 'Data biometrik dihapus.']);
    }
}
