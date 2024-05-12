<?php

namespace App\Http\Controllers;

use App\Models\Auth_desp;
use App\Models\AuthIcon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
      function auth_info(){
        $auth_icons = AuthIcon::where('author_id', Auth::id())->get();
        $auth_desps = Auth_desp::where('author_id', Auth::id())->get();
        return view('backend.auth_info.auth_info', [
          'auth_desps'=>$auth_desps,
          'auth_icons'=>$auth_icons,
        ]);
    }

    function auth_desp_store(Request $request){
      $request->validate([
        'auth_desp'=>'required',
      ]);

      Auth_desp::insert([
        'author_id'=>Auth::user()->id,
        'auth_desp'=>$request->auth_desp,
        'created_at'=>Carbon::now(),
      ]);

      return back()->with('desp_suc', 'Add Successful');
    }

    function desp_delete($id){
      $auth_desps = Auth_desp::find($id);
      $auth_desps->delete();
      return back()->with('desp_del', 'Delete Successful');
    }

    function desp_edit($id){
       $auth_desps = Auth_desp::where('author_id', Auth::id())->where('id', $id)->get();
       return view('backend.auth_info.auth_desp_edit', [
        'auth_desps'=>$auth_desps,
       ]);
    }

    function auth_desp_update(Request $request, $id){
      $auth_desps = Auth_desp::find($id);
       $request->validate([
        'auth_desp'=>'required',
      ]);

      $auth_desps->update([
        'auth_desp'=>$request->auth_desp,
      ]);
      return back()->with('desp_edit_suc', 'Update Successful');
    }

    function auth_icon_store(Request $request){
     
      $request->validate([
        'icon'=>'required',
        'link'=>'required|url',
      ]);

      AuthIcon::insert([
        'author_id'=>Auth::id(),
        'icon'=>$request->icon,
        'link'=>$request->link,
        'created_at'=>Carbon::now(),
      ]);
      return back()->with('icon_suc', 'Add Successful');
    }

    function icon_edit($id){
      $icon = AuthIcon::find($id);
      return view('backend.auth_info.auth_icon_edit', [
        'icon'=>$icon,
      ]);
    }

    function auth_icon_update(Request $request, $id){
      $request->validate([
        'icon'=>'required',
        'link'=>'required|url',
      ]);

      AuthIcon::find($id)->update([
        'icon'=>$request->icon,
        'link'=>$request->link,
      ]);
      return back()->with('icon_update', 'Update Successful');
    }

    function icon_delete($id){
      AuthIcon::find($id)->delete();
      return back()->with('icon_del', 'Delete Successful');
    }
}
