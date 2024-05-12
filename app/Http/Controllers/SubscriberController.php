<?php

namespace App\Http\Controllers;

use App\Models\subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{

    function subscribe_store(Request $request){
        $request->validate([
            'email'=>'required|email|unique:subscribes'
        ]);

        subscribe::insert([
            'email'=>$request->email,
            'created_at'=>Carbon::now(),
        ]);
         return back()->with('sub_add', 'Subscribe Successful' );
    }

    function subscriber(){
        $subscribers = subscribe::all();
        return view('backend.subscriber.subscriber', [
            'subscribers'=>$subscribers,
        ]);
    }

    function subscriber_delete($subscribe_id){
        subscribe::find($subscribe_id)->delete();
        return back()->with('email_del', 'Delete Successful');
    }
}
