<?php

namespace App\Http\Controllers;

use App\Models\Admindesp;
use App\Models\Adminicon;
use App\Models\Contact;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function admin_info(){
        $admin_desp = Admindesp::all();
        $admin_icons = Adminicon::all();
        return view('backend.admin_info.admin_info', [
            'admin_desp'=>$admin_desp,
            'admin_icons'=>$admin_icons,
        ]);
    }

    function admin_desp_store(Request $request){

        $request->validate([
            'admin_desp'=>'required',
        ]);

      Admindesp::insert([
        'admin_desp'=>$request->admin_desp,
        'created_at'=>Carbon::now(),
      ]);

      return back()->with('admin_desp_suc', 'Add Successful');
    }

    function admin_icon_store(Request $request){
        $request->validate([
            'icon'=>'required',
            'link'=>'required',
        ]);

      Adminicon::insert([
        'icon'=>$request->icon,
        'link'=>$request->link,
        'created_at'=>Carbon::now(),
      ]);

      return back()->with('admin_icon_suc', 'Add Successful');
    }

    function admin_desp_edit($id){
      $admin_desp = Admindesp::find($id);
      return view('backend.admin_info.admin_desp_edit', [
        'admin_desp'=>$admin_desp,
      ]);
    }

    function admin_desp_update(Request $request, $id){
      $admin_desps = Admindesp::find($id);
        $request->validate([
          'admin_desp'=>'required',
        ]);

        $admin_desps->update([
          'admin_desp'=>$request->admin_desp,
        ]);
        return back()->with('admin_desp_edit_suc', 'Update Successful');
    }

    function admin_desp_delete($id){
      Admindesp::find($id)->delete();
      return back()->with('admin_desp_del', 'Delete Successful');
    }

    function admin_icon_edit($id){
      $admin_icon = Adminicon::find($id);
      return view('backend.admin_info.admin_icon_edit', [
        'admin_icon'=>$admin_icon,
      ]);
    }

    function admin_icon_update(Request $request, $id){
       $request->validate([
        'icon'=>'required',
        'link'=>'required|url',
      ]);

      Adminicon::find($id)->update([
        'icon'=>$request->icon,
        'link'=>$request->link,
      ]);
      return back()->with('admin_icons_update', 'Update Successful');
    }

    function admin_icon_delete($id){
      Adminicon::find($id)->delete();
      return back()->with('admin_icon_del', 'Delete Successful');
    }

    function contact_info(){
      $contacts = Contact::all();
      return view('backend.admin_contact.contact_info', [
        'contacts'=>$contacts,
      ]);
    }

    function contact_store(Request $request){
      $request->validate([
        'number'=>'required',
        'email'=>'required',
        'location'=>'required',
      ]);

      Contact::insert([
        'number'=>$request->number,
        'email'=>$request->email,
        'location'=>$request->location,
        'created_at'=>Carbon::now(),
      ]);

      return back()->with('contact_suc', 'Contact Add Successful');
    }

    function contact_delete($id){
      Contact::find($id)->delete();
      return back()->with('contact_del', 'Delete Successful');
    }

    function contact_edit($id){
      $contact = Contact::find($id);
      return view('backend.admin_contact.contact_edit', [
        'contact'=>$contact,
      ]);
    }

    function contact_update(Request $request, $id){
      $request->validate([
        'number'=>'required',
        'email'=>'required',
        'location'=>'required',
      ]);

      Contact::find($id)->update([
        'number'=>$request->number,
        'email'=>$request->email,
        'location'=>$request->location,
      ]);

      return back();
    }

    function view_all_post(){
      $posts = Post::paginate(10);
      return view('backend.admin_info.view_all_post', [
        'posts'=>$posts,
      ]);
    }
}
