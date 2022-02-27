<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Socket;

class GoogleController extends Controller
{
    CONST GOOGLE_TYPE = 'google';
    public function handleGoogleRedirect(){
        return Socialite::driver(static::GOOGLE_TYPE)->stateless()->redirect();
    }
    public function handleGoogleCallback(){
        try {
            $user = Socialite::driver(static::GOOGLE_TYPE)->stateless()->user();
            $userExist = User::where('oauth_id',$user->id)->where('oauth_type',static::GOOGLE_TYPE)->first();
            if($userExist){
                Auth::login($userExist);
                return redirect()->route('dashboard');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauh_id' => $user->id,
                    'oauh_type' => static::GOOGLE_TYPE,
                    'password' => Hash::make($user->id)
                    // 'password' => $user->password
                ]);

                Auth::login($newUser);
                return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
            dd($e);
        } 
    }
}
