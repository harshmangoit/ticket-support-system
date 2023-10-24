<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginConroller extends Controller
{
    public function provider($social)
    {
        return Socialite::driver($social)->redirect();
    }
    public function callbackHandel($social)
    {
        $user = Socialite::driver($social)->user();

        $data = User::where('email', $user->email)->first();
        if (is_null($data)) {
            return redirect()->route('register')->with(['name' => $user->name, 'email' => $user->email]);
        } else {
            Auth::login($data);
            return redirect('dashboard');
        }
    }
}
