<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Laravel\Ui\Presets\React;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function delete_check(Request $request){
        if($request->check == ''){
            return back()->with('nai', 'no data selected');
        }
        else{
            foreach($request->check as $check_user){
                User::find($check_user)->delete();
            }
            return back();
        }

    }

    function users(){
        $users = User::where('id', '!=', Auth::id())->orderBy('name', 'asc')->paginate(10);
        $total_user = User::count();
        return view('admin.users.user', compact('users', 'total_user'));
    }
    function trash(){
        $users = User::onlyTrashed()->where('id', '!=', Auth::id())->orderBy('name', 'asc')->get();
        $total_user = User::count();
        return view('admin.users.trash', [
            'users'=>$users,
            'total_user'=>$total_user,
        ]);
    }

    function restore($user_id){
        User::withTrashed()->find($user_id)->restore();
        return back();
    }


    function user_delete($user_id){
        User::find($user_id)->delete();
        return back();
    }

    function hard_delete($user_id){
        $image = User::onlyTrashed()->find($user_id);
        $delete_from = public_path('uploads/user/'.$image->image);
        unlink($delete_from);
        User::onlyTrashed($user_id)->forceDelete();
        return back();
    }

    function profile_edit(){
        return view('admin.users.profile');
    }
    function profile_update(Request $request){
        if($request->password == ''){
            User::find(Auth::id())->update([
                'name'=>$request->name,
                'email'=>$request->email,
            ]);
        }
        else{
            if(Hash::check($request->old_password, Auth::user()->password)){
                User::find(Auth::id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password),
                ]);
                return back()->withSuccess('User Updated!');
            }
            else{
                return back()->with('error', 'Old Password ulta palta ken des re???');
            }
        }
    }

    function photo_update(Request $request){
        $uploaded_file = $request->photo;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Auth::id().'.'.$extension;
        Image::make($uploaded_file)->save(public_path('uploads/user/'.$file_name));
        User::find(Auth::id())->update([
            'image'=>$file_name,
        ]);
        return back();
    }


    function hard_delete_check(Request $request){
        if($request->click == 1){
            echo' delete e click kore ashche';
        }
        else{
            echo 'restore click kore ashche';
        }
    }
}
