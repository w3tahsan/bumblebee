<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use App\Models\GuestMailVerify;
use App\Notifications\GuestMailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class GuestRegisterController extends Controller
{

    function guest_register(){
        return view('frontend.guest_register');
    }
    function guest_login(){
        return view('frontend.guest_login');
    }

    function guest_store(Request $request)  {
        $guest_info = GuestLogin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);

        $guest_info_inserted = GuestMailVerify::create([
            'guest_id'=>$guest_info->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);

        Notification::send($guest_info, new GuestMailVerifyNotification($guest_info_inserted));
        return back()->withReqsend('We have sent you a Email Verify link! please check your email');

        // if(Auth::guard('guestlogin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
        //     return redirect()->route('index')->withGuest_login('You have successfully login');
        // }
    }

    function verify_mail($token){
        $guest = GuestMailVerify::where('token', $token)->firstOrFail();
        GuestLogin::findOrFail($guest->guest_id)->update([
            'email_verified_at'=>Carbon::now()->format('Y-m-d'),
        ]);
        $guest->delete();
        return redirect()->route('guest.login')->withVerify('Your Email Verified Successfully! Now You Can Login');
    }


    function mail_verify_req(){
        if(Auth::guard('guestlogin')->user()){
            if(Auth::guard('guestlogin')->user()->email_verified_at == null){
                return view('frontend.mail_verify_req');
            }
            else{
                return redirect('/');
            }
        }
        else{
            return view('frontend.mail_verify_req');
        }



    }

    function mail_verify_again(Request $request){
        $guest_info = GuestLogin::where('email', $request->email)->firstOrFail();
        GuestMailVerify::where('guest_id', $guest_info->id)->delete();

        $guest_info_inserted = GuestMailVerify::create([
            'guest_id'=>$guest_info->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);
        Notification::send($guest_info, new GuestMailVerifyNotification($guest_info_inserted));
        return back()->withReqsend('We have sent you a Email Verify link! please check your email');
    }
}
