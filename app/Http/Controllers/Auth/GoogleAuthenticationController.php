<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthenticationController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $user = User::firstOrCreate([
            'email' => $user->getEmail(),
        ],[
            'name' => $user->getName(),
            'google_id' => $user->getId(),
            'password' => Hash::make($user->token),
            'default_password' => Hash::make($user->token),
            'email_verified_at' => now()
        ]);

        Auth::login($user, true);

        return redirect('/');
    }
}
