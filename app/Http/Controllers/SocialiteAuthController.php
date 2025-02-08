<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('passport')->redirect();
        
    }

    public function authenticate(){
        try {
            $socialiteUser = Socialite::driver('passport')->user();
            $user = User::firstOrCreate(
                ['email' => strtolower($socialiteUser->getEmail())],
                ['name' => $socialiteUser->getNickname(), 'password' => Hash::make(time())]
            );
            Auth::login($user);
            return to_route('dashboard');
        } catch (Exception $exception){
            dd(Socialite::driver('passport')->user());
            return to_route('home');
            
        }
    }
}
