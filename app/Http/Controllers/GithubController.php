<?php

namespace App\Http\Controllers;

use App\Models\Guestlogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
 
    function github_redirect(){
        return Socialite::driver('github')->redirect();
    }

    function github_callback(){
        $user = Socialite::driver('github')->user();

        if(Guestlogin::where('email', $user->getEmail())->exists()){
            if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail() , 'password'=>'Sohel@12'] )){
                return redirect()->route('index')->with('guest_suc', 'Login Successfull');
            }
        }

        Guestlogin::insert([
            'name'=>$user->getName(),
            'email'=>$user->getEmail(),
            'password'=>bcrypt('Sohel@12'),
            'created_at'=>Carbon::now(),
        ]);

        if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail() , 'password'=>'Sohel@12'] )){
            return redirect()->route('index')->with('guest_suc', 'Login Successfull');
        }
    }
}
