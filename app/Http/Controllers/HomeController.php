<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\RecruitmentTag;
use App\Models\Recruitment;
use Illuminate\Support\Facades\DB;

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
        $tags = Tag::with('users')->get();

        foreach($tags as $tag){
            $users = $tag->users;
            //　↑のように変数に入れよう
            // $users = []; 
            // ↑collectionを取り出すときは配列に入れたくなるけど入れてはいけない！！！
        };

        // 月間トレンドの取得
        
        $this_month = date("Y-m-01");
        $end_this_month = date("Y-m-d",mktime(0, 0, 0, date("m")+1 , 1 -1,   date("Y")));
        // dd(date("Y-m-d",$end_this_month));
        // $trend_tags = RecruitmentTag::query()
        //                  ->orderBy('created_at','desc')
        //                  ->where('created_at', '>=', $this_month)
        //                  ->where('created_at', '<=', $next_month)
        //                  ->get();
        
        $trend_tags = DB::table('recruitment_tag')
                        ->select(DB::raw('tag, count(tag_id), tag_id'))
                        ->join('tags','tags.id','=','recruitment_tag.tag_id')
                        ->join('recruitments','recruitments.id','=','recruitment_tag.recruitment_id')
                        ->where('recruitments.delete_flag',0)
                        ->where('recruitment_tag.created_at', '>=', $this_month)
                        ->where('recruitment_tag.created_at', '<=', $end_this_month)
                        ->groupBy('tag', 'tag_id')
                        // ↑Laravelではgroupbyの引数はselectの全てを指定する必要がある（らしい）
                        ->orderBy('count(tag_id)','desc')
                        ->limit(30)
                        ->get();
        // dd($trend_tags);
        $favorite_tags = Auth::user()->favoriteTags;
        foreach($favorite_tags as $favorite_tag)
        {
            $recruitments = Recruitment::whereHas('tags',function($query) use($favorite_tag){
                $query->where('tags.id',$favorite_tag->id)
                        ->where('recruitments.delete_flag',0);
            })->get();
        }

        return view('home',[
            "users" => $users,
            "trend_tags" => $trend_tags,
            "new_notices" => $request->new_notices,
            "count_new_notices" => $request->count_new_notices,
            "management_notices" => $request->management_notices,
            "recruitments" => $recruitments,
        ]);
    }
}
