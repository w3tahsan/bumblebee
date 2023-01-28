<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\GuestLogin;
use App\Models\GuestPassReset;
use App\Notifications\GuestPassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class GuestController extends Controller
{
    function pass_reset_req()
    {
        return view('frontend.pass_reset_req');
    }

    function pass_reset_req_send(Request $request)
    {
        $guest_info = GuestLogin::where('email', $request->email)->firstOrFail();
        GuestPassReset::where('guest_id', $guest_info->id)->delete();

        $guest_inserted = GuestPassReset::create([
            'guest_id' => $guest_info->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        Notification::send($guest_info, new GuestPassResetNotification($guest_inserted));
        return back()->withReqsend('We have sent you a password reset link! please check your email');
    }

    function pass_reset_form($token)
    {
        if (GuestPassReset::where('token', $token)->exists()) {
            return view('passreset.pass_reset_form', [
                'token' => $token,
            ]);
        } else {
            abort('404');
        }
    }

    function guest_pass_reset(Request $request)
    {
        $guest_info = GuestPassReset::where('token', $request->token)->firstOrFail();
        GuestLogin::findOrFail($guest_info->guest_id)->update([
            'password' => bcrypt($request->password),
        ]);

        $guest_info->delete();

        return redirect()->route('guest.login')->withResetsucces('Password Reset Successfully');
    }

    function comment_store(Request $request)
    {
        Comment::insert([
            'post_id' => $request->post_id,
            'guest_id' => Auth::guard('guestlogin')->id(),
            'comment' => $request->comment,
            'parent_id' => $request->parent_id,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
}
