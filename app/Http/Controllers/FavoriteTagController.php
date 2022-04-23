<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteTagController extends Controller
{
    public function show(){
        $tags = Auth::user()->favoriteTags;
        return view('user.settingFavoriteTags')->with([
            'tags' => $tags,
        ]);
    }

    public function register(){
        
    }

    public function update(Request $request){
        $updateTags = $request->updateTags;
        dd($updateTags);
        // ↑の配列を使ってsyncメソッドで一括更新する
    }
}
