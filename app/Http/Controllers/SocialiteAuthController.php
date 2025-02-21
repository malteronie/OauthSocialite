<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
class SocialiteAuthController extends Controller
{
    public function redirect(){
        $authUrl = Socialite::driver('passport')->redirect()->getTargetUrl();
        $redirectTo = urlencode('https://localhost:8001/oauth/callback'); 
        // dd($authUrl . '&state=' . $redirectTo); 
        return redirect()->to($authUrl . '&state=' . $redirectTo);
    }

    public function authenticate(){
         try {
            // return Socialite::driver('passport')->stateless()->user();
            $socialiteUser = Socialite::driver('passport')->user();
            $user = User::firstOrCreate(
                ['email' => strtolower($socialiteUser->getEmail())],
                ['name' => $socialiteUser->getName(), 'password' => Hash::make(time()), ],
            );
            Auth::login($user);
            return to_route('dashboard');
        } catch (Exception $exception){
            // dd($exception);
            dd($exception);
            dd(Socialite::driver('passport')->user());
            return to_route('home');
        }
    }
}



// $user = Socialite::driver('passport')->user();
    
//     // Obtenez le jeton d'accès
//         $accessToken = $user->token;
//     // dd($user, $accessToken);
//         session(['access_token' => $accessToken]);

//     // Redirige l'utilisateur vers une page sécurisée
//         return redirect('/dashboard');
