<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function showLoginPage(Request $req) {
        return view('login');
    }

    public function login(Request $req) {
        $data = $req->validate([
            'email' => 'string',
            'password' => 'string'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return redirect()
                ->route('login-form')
                ->with('avity_error', true)
                ->with('message', 'Email or Password does not match.');
        }

        if ($user->password !== $data['password']) {
            return redirect()
                ->route('login-form')
                ->with('avity_error', true)
                ->with('message', 'Email or Password does not match.');
        }

        Auth::login($user);
        return redirect()->route('app');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
