<?php

namespace App\Http\Controllers;

use App\Models\Guestlogin;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    function profile(){
        return view('backend.user.profile');
    }

    function profile_update(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
        ]);

        if($request->password == ''){
            User::find(Auth()->user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
            ]);
            return back()->with('pass_success', 'Profile Update Successful');
        }
        else{
            if(Hash::check($request->old_password, Auth()->user()->password)){
                if($request->password){
                    $request->validate([
                        'password' => 'required|min:8|max:10',
                    ]);

                    User::find(Auth()->user()->id)->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'password'=>$request->password,
                    ]);
                    return back()->with('pass_success', 'Profile Update Successful');
                }
            }
            else{
                return back()->with('pass_wrong_err', 'Current Password Is Wrong');
            }
        }

    }

    function profile_photo_update(Request $request){
        $request->validate([
            'profile_photo'=>'required|file'
        ]);

        $user = User::find(Auth::user()->id);
        $guest = Guestlogin::where('email', $user->email)->first();

        if($user->profile_photo != NULL && $guest->photo != NULL){
            $img_location = public_path('uploads/user/'.$user->profile_photo);
            unlink($img_location);
            $img_location2 = public_path('uploads/user/'.$guest->photo);
            unlink($img_location2);

            $image = $request->file('profile_photo');
            $extension = $image->extension();
            $file_name = Auth()->user()->id.'.'.$extension;
            image::make($image)->save(public_path('uploads/user/'.$file_name));

            User::find(Auth()->user()->id)->update([
                'profile_photo'=> $file_name,
            ]);

            $guest->update([
                'photo'=>$file_name,
            ]);

            return back()->with('profile_photo_update', 'Profile Photo Update Successful');
        }
        else{
            $image = $request->file('profile_photo');
            $extension = $image->extension();
            $file_name = Auth()->user()->id.'.'.$extension;
            image::make($image)->save(public_path('uploads/user/'.$file_name));

            User::find(Auth()->user()->id)->update([
                'profile_photo'=> $file_name,
            ]);

            $guest->update([
                'photo'=>$file_name,
            ]);
            return back()->with('profile_photo_update', 'Profile Photo Update Successful');
        }
    }

    function user_list(){
        $users = User::paginate(10);
        return view('backend.user.user_list', [
            'users'=>$users,
        ]);
    }

    function user_delete($user_id){
        $post = Post::where('author_id', $user_id)->get();
        $image_location = public_path('uploads/blog/'.$post->first()->blog_image);
        unlink($image_location);
        $post->first()->delete();

        $user = User::find($user_id);
        if($user->profile_photo == NULL){
            $user->delete();
            return back()->with('user_delete', 'User Delete Successful');
        }
        else{
            $img_location = public_path('uploads/user/'.$user->profile_photo);
            unlink($img_location);

            $user->delete();
            return back()->with('user_delete', 'User Delete Successful');
        }
    }
}
