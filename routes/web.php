<?php

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
    Route::get('oauth/redirect', 'redirect')->name('oauth.redirect');
    Route::get('oauth/callback', 'authenticate');
});

Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');



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