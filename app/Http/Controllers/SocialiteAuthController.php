<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
class SocialiteAuthController extends Controller
{
    public function redirect(Request $request){
        return Socialite::driver('passport')->redirect();
    }

    public function authenticate(){
        $user = Socialite::driver('passport')->user();
    
    // Obtenez le jeton d'accès
        $accessToken = $user->token;
    
    // Utilise le jeton d'accès dans ton application
    // Par exemple, tu peux l'enregistrer dans la session
        session(['access_token' => $accessToken]);

    // Redirige l'utilisateur vers une page sécurisée
        return redirect('/dashboard');
    }
}
