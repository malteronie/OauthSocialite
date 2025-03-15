<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
class SocialiteAuthController extends Controller
{
    public function redirect(){
        $redirectUri = urlencode(route('oauth.callback')); // URL de retour
        return redirect("http://localhost:8002/oauth/redirect?redirect_uri={$redirectUri}");
    }
    
    public function authenticate(Request $request){
        $token = $request->query('token');
        if (!$token) {
            return redirect('/')->withErrors(['error' => 'Token is missing']);
        }
        
        // Stocker le token en session
        session(['access_token' => $token]);

        // Récupérer les infos utilisateur depuis App 2
        $response = Http::withToken($token)->get('http://localhost:8002/api/user');
        // dd($response);
        if ($response->failed()) {
            
            return redirect('/')->withErrors(['error' => 'Failed to fetch user data']);
        }

        // Stocker les infos utilisateur en session
        $user = $response->json();
        try {
    
             // Trouve ou crée l'utilisateur
             $user = User::firstOrCreate(
                 ['email' => $user['email']],
                 ['name' => $user['name'], 'password' => 'password'],
             );
    
             // Connecte l'utilisateur
             session(['user' => $user]);
            Auth::guard('web_app3')->login($user);
             return redirect('/dashboard');
             // Récupère l’URL de redirection (App3 ou App4) stockée en session
    
        } catch (Exception $exception) {
            dd($exception);
        }


        // Rediriger vers la page d'accueil ou dashboard
    }
}
    
    
    




// $user = Socialite::driver('passport')->user();
    
//     // Obtenez le jeton d'accès
//         $accessToken = $user->token;
//     // dd($user, $accessToken);
//         session(['access_token' => $accessToken]);

//     // Redirige l'utilisateur vers une page sécurisée
//         return redirect('/dashboard');


// public function g(Request $request)
//     {
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
    
//         $redirectUri = urlencode(route('oauth.callback')); // URL de retour après authentification
    
//         // Construit l’URL de redirection vers App2 avec le paramètre state
//         $authUrl = "http://localhost:8002/oauth/redirect?state={$redirectUri}";
    
//         return redirect($authUrl);
//     }