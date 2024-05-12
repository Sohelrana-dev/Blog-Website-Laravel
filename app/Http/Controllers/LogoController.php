<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class LogoController extends Controller
{
     function logo_update(){
        $logos = Logo::all();
        return view('backend.logo.logo_update', [
            'logos'=>$logos,
        ]);
    }

    function logo_store(Request $request, $logo_id){
        $logos = Logo::find($logo_id);
        $request->validate([
            'logo'=>'required|image'
        ]);

        $image_location = public_path('uploads/logo/'.$logos->logo);
        unlink($image_location);

        $logo = $request->file('logo');
        $extension = $logo->extension();
        $file_name = 'logo'.'-'.uniqid().'.'.$extension;
        image::make($logo)->save(public_path('uploads/logo/'.$file_name));

        Logo::find($logo_id)->update([
            'logo' =>$file_name,
        ]);
        return back()->with('logo_suc', 'Logo Update Successful');
    }
}
