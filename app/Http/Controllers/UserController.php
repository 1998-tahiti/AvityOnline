<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showProfile() {
        return view('me');
    }

    public function updateProfile(Request $req) {
        $user = Auth::user();

        $data = $req->validate([
            'name' => 'string|nullable',
            'email' => 'required|email',
            'number' => 'string|nullable',
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8',
            'confirm_new_password' => 'same:new_password'
        ]);

        if (isset($data['name']) && $data['name']) {
            $user->name = $data['name'];
        }

        if (isset($data['email']) && $data['email']) {
            $user->email = $data['email'];
        }

        if (isset($data['number']) && $data['number']) {
            $user->number = $data['number'];
        }

        if (isset($data['old_password']) && $data['old_password']) {
            if ($data['old_password'] !== $user->password) {
                return redirect()->route('profile')->with('message', 'Old password is incorrect')->with('avity_error', true);
            }

            $user->password = $data['new_password'];
        }

        $user->save();

        return redirect()->route('profile')->with('message', 'Profile Saved.');
    }

    public function upgrade(Request $req) {
        $user = Auth::user();

        $data = $req->validate([
            'name' => 'required|string',
            'number' => 'required|string',
            'billing_address' => 'required|string',
            'trnx_id' => 'required|string'
        ]);


        if (isset($data['name']) && $data['name']) {
            $user->name = $data['name'];
        }

        if (isset($data['number']) && $data['number']) {
            $user->number = $data['number'];
        }

        $user->upgrade_transaction_id = $data['trnx_id'];
        $user->billing_address = $data['billing_address'];

        $user->save();

        return redirect()->route('profile')->with('message', 'Your billing details has been saved, we will verify and upgrade your profile shortly.');
    }


    public function upgrades() {
        $users = User::where('is_upgraded', false)->whereNotNull('upgrade_transaction_id')->get();

        return view('upgrades', [
            'users' => $users
        ]);
    }

    public function confirm($user_id) {
        $user = User::find($user_id);

        $user->is_upgraded = true;
        $user->save();

        return redirect()->route('upgrades');
    }

    public function reject($user_id) {
        $user = User::find($user_id);

        $user->upgrade_transaction_id = '';
        $user->is_upgraded = false;
        $user->save();

        return redirect()->route('upgrades');
    }
}
