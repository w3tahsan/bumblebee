<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    function redirect_provider(){
        return Socialite::driver('google')->redirect();
    }
    function provider_to_application(){
        $user = Socialite::driver('google')->user();

        if(GuestLogin::where('email', $user->getEmail())->exists()){
            if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'abc@123'])){
                return redirect()->route('index')->withGuest_login('You have successfully login');
            }
        }
        else{
            GuestLogin::insert([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt('abc@123'),
                'created_at'=>Carbon::now(),
            ]);

            if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'abc@123'])){
                return redirect()->route('index')->withGuest_login('You have successfully login');
            }
        }


    }
}
