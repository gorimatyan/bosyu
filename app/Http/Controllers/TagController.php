<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function show($tag){
        $searched_tag = Tag::where('tag',$tag)->with('recruitments')->first(); 
        // $related_recruitments = Tag::query()
        //                         ->where('tag',$tag)
        //                         ->whereHas('tags',);
        // dd($searched_tag);

        return view('tag.show')->with([
            'searched_tag' => $searched_tag
        ]);
    }
}
