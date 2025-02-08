<?php

use App\Http\Controllers\SocialiteAuthController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/auth/redirect', function(){
    return Socialite::driver('passport')->redirect();
});