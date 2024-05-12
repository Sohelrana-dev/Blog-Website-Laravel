<?php

namespace App\Http\Controllers;

use App\Models\Guestlogin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    function guest_register(){
        return view('frontend.guest_register');
    }

    function guest_login(){
        return view('frontend.guest_login');
    }

    function guest_store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:guestlogins',
            'password'=>['required',Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
        ]);

        Guestlogin::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);

        $user_id = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ])->id;

        $user = User::find($user_id);
        $user->assignRole('Author');

        if(Auth::guard('guestlogin')->attempt(['email'=>$request->email , 'password'=>$request->password] )){
            return redirect()->route('index')->with('guest_suc', 'Login Successfull');
        }
    }

    function guest_login_req(Request $request){
        if(Auth::guard('guestlogin')->attempt(['email'=>$request->email , 'password'=>$request->password] )){
            return redirect()->route('index')->with('guest_suc', 'Login Successfull');
        }
        else{
            return redirect()->route('guest.login')->with('guest_wrong', 'Credential Does Not Match');
        }
    }

    function guest_logout(){
        Auth::guard('guestlogin')->logout();
        return redirect()->route('guest.login');
    }
}
