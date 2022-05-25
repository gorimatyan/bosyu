<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FavoriteTagController extends Controller
{
    public function show(){
        $tags = Auth::user()->favoriteTags;

        return view('userSettings.settingFavoriteTags')->with([
            'tags' => $tags,
        ]);
    }

    public function register(Request $request){
        // {{ route('user.registerFavoriteTags') }}
        $user = Auth::user();
        $user_tags = Auth::user()->favoriteTags;
        $register_tag = Tag::where('tag',$request->tag)->first();
        $detach_tag = $user_tags->where('tag',$request->tag)->first();
        if(empty($detach_tag)){
            $user->favoriteTags()->attach($register_tag->id);
        }else{
            $user->favoriteTags()->detach($detach_tag->id);
        }
        dd($register_tag);

    }

    public function update(Request $request){
        $updateTags = $request->updateTags;
        // dd($updateTags);
        $user = Auth::user();
        $user->favoriteTags()->sync($updateTags);

        // ↑の配列を使ってsyncメソッドで一括更新する
    }
}
