<?php

namespace App\Http\Controllers;

use App\Models\tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function tag(){
        $tags = tag::paginate(8);
        return view('backend.tag.tag', [
            'tags'=>$tags,
        ]);
    }

    function tag_store(Request $request){
        $request->validate([
            'tag_name'=>'required',
        ]);

        tag::insert([
            'tag_name'=>$request->tag_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('tag_suc', 'Tag Added Successful');
    }

    function tag_delete($tag_id){
        $tag = tag::find($tag_id);
        $tag->delete();
        return back()->with('tag_del', 'Tag Delete Successful');
    }
}
