<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\Recruitment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        $tags = Tag::all();
        // $users = []; 
        // ↑collectionを取り出すときは配列に入れたくなるけど入れてはいけない！！！
        foreach($tags as $tag){
            $users = $tag->users;
            //　↑のように変数に入れよう
        };

        // dd(isset($request->new_notices));

        return view('home',[
            "users" => $users,
            "new_notices" => $request->new_notices,
            "count_new_notices" => $request->count_new_notices,
            "management_notices" => $request->management_notices,
        ]);
    }
}
