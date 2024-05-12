<?php

namespace App\Http\Controllers;

use App\Models\Guestmessage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestmessageController extends Controller
{
    function guest_message(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required',
        ]);

        Guestmessage::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('message_suc', 'Massege Sent Successful');
    }

    function visitor_message(){
        $messages = Guestmessage::paginate(10);
        return view('backend.visitor_message.visitor_message', [
            'messages'=>$messages,
        ]);
    }

    function visitor_message_delete($id){
        Guestmessage::find($id)->delete();
        return back()->with('visitor_mes_del', 'Message Delete Successful');
    }
}
