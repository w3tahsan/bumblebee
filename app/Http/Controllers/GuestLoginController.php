<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestLoginController extends Controller
{
    function guest_login_req(Request $request){
        if(Auth::guard('guestlogin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            if(Auth::guard('guestlogin')->user()->email_verified_at == null){
                Auth::guard('guestlogin')->logout();
                return redirect()->route('mail.verify.req')->with([
                    'verify_req'=>'Plesse Verify Your Mail First! Check Your email',
                    'mail'=>$request->email,
                ]);
            }
            else{
                return redirect()->route('index')->withGuest_login('You have successfully login');
            }

        }
        else{
            return redirect()->route('guest.login');
        }
    }

    function guest_logout(){
        Auth::guard('guestlogin')->logout();
        return redirect()->route('guest.login');
    }
}
