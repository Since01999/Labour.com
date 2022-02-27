<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Social Logins

Route::get('/auth/google/redirect',[LoginController::class,'redirectToGoogleProvider']);
Route::get('/auth/google/callback',[LoginController::class,'handleGoogleProviderCallback']);

Route::view('dashboard','dashboard')->name('dashboard');