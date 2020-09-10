<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function showRegistrationPage() {
        return view('register');
    }

    public function register(Request $req) {
        $data = $req->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'confirm' => 'required|string|same:password'
        ]);

        $user = new User();
        $user->email = $data['email'];
        $user->password = $data['password'];

        $user->save();

        return redirect()->route('login-form')->with('message', 'You are registered, please login.');
    }
}
