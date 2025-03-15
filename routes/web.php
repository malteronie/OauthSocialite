<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SocialiteAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::controller(SocialiteAuthController::class)->group(function(){
   
    Route::get('/oauth/callback', 'authenticate')->name('oauth.callback');
    Route::get('/oauth/redirect', 'redirect')->name('oauth.redirect');
});

Route::get('/logout', [LoginController::class, 'logout'])->name("logout");

Route::middleware(['auth:web_app3'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// Route::get('/app/callback', function (Request $request) {
//     // Récupérer le token de l’URL
//     $token = $request->query('token');
//     dd($request);
//     if (!$token) {
//         return redirect('/login')->withErrors(['error' => 'Échec de l’authentification']);
//     }

//     // Stocker le token dans la session ou le système de gestion d'authentification
//     session(['access_token' => $token]);

//     // Rediriger l’utilisateur vers le tableau de bord
//     return redirect('/dashboard');
// })->name('app.callback');

// Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');



// Route::get('oauth/callback', function (Request $request) {
//     $state = $request->session()->pull('state');
    
 
//     $response = Http::asForm()->post('http://localhost:8000/oauth/token', [
//         'grant_type' => 'authorization_code',
//         'client_id' => env('client-id'),
//         'client_secret' => env('client-secret'),
//         'redirect_uri' => 'http://localhost8001/oauth/callback',
//         'code' => $request->code,
//     ]);
//  dd($response);
//     return $response->json();
// });