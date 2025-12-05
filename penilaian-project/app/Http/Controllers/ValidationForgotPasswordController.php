<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ValidationForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.validation-token');
    }

    public function store(Request $request, $token)
    {
        $getToken = PasswordResetToken::where('token', $token)->first();

        if (!$getToken) {
            return redirect('forgot-password')->with('failed', 'Token tidak valid!');
        }

        return view('auth.validation-token', compact('token'));
    }

    public function changePassword(Request $request)
    {
        $customMessage = [
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 5 karakter',
            'password.same' => 'Konfirmasi harus sama dengan Password',
        ];

        $request->validate([
            'password' => 'required|min:5|same:konfirmasiPasswordBaru'
        ], $customMessage);

        $token = PasswordResetToken::where('token', $request->token)->first();

        if (!$token) {
            return redirect('forgot-password')->with('failedToken', 'Token tidak valid!');
        }

        $user = User::where('email', $token->email)->first();

        if (!$user) {
            return redirect('forgot-password')->with('failedEmail', 'Email tidak terdaftar!');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $token->delete();

        return redirect('/')->with('successReset', 'Password berhasil diganti!');
    }
}
