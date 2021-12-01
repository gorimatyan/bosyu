<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use PhpParser\Node\Expr\FuncCall;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recruitment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recruitment = new Recruitment;

        // ログイン中のユーザー情報の取得が必要
        $recruitment->user_id = Auth::user()->id;

        $recruitment->title = $request->input('title');
        $recruitment->number_of_people = $request->input('number_of_people');
        $recruitment->body = $request->input('body');
        $recruitment->deadline = $request->input('deadline');

        // ユニークな募集IDをDBと照らし合わせて取得
        for($id = uniqid(); DB::table('recruitments')->where('id', $id)->exists();)
        {
            $id = uniqid();
        }
            $recruitment->id = $id;
            $recruitment->save();

        return redirect()->route('recruitment.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($recruitment_id)
    {   
        $recruitment = Recruitment::find($recruitment_id);
        // 投稿のユーザーを呼び出す
        $user = $recruitment->user;
        // 投稿に関連するコメント（userとrecruitmentの中間テーブル）を呼び出す
        $comments = $recruitment->users;

        //　募集詳細のviewにルートパラメータから得た募集とそれに紐づくユーザー情報を取得
        return view('recruitment.show')->with([
            "recruitment" => $recruitment,
            "user" => $user,
            "comments" => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($recruitment_id)
    {
        $recruitment = Recruitment::find($recruitment_id);
        $user = $recruitment -> user;

        return view('recruitment.edit')->with([
            "recruitment" => $recruitment,
            "user" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $recruitment_id)
    {   
        $recruitment = Recruitment::find($recruitment_id);
        // dd($recruitment);

        $recruitment->title = $request->input('title');
        $recruitment->number_of_people = $request->input('number_of_people');
        $recruitment->body = $request->input('body');
        $recruitment->deadline = $request->input('deadline');

        $recruitment->save();

        return redirect()->route('recruitment.show',[ "recruitment_id" => $recruitment -> id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function search(Request $request)
    {   
        $keyword = $request->input('keyword');
        $search = $request->input('keyword');

        //1.全角スペースを半角スペースに変換
        $keyword = str_replace('　', ' ', $keyword);
        //2.前後のスペース削除（trimの対象半角スペースのみなので半角スペースに変換後行う）
        $keyword = trim($keyword);
        //3.連続する半角スペースを半角スペースひとつに変換
        $keyword = preg_replace('/\s+/', ' ', $keyword);
        //分割
        $keywords = explode(' ',$keyword);
        
        $recruitments = Recruitment::paginate(20);
        $query = Recruitment::query();
        // まず検索に引っかかる募集のコレクションクラスを取得
        foreach($keywords as $keyword)
        {
            $query->where(function($query) use($keyword)
            {
                $query->where('title' ,'like', "%{$keyword}%")
                      ->orwhere('body' ,'like', "%{$keyword}%");
            });
                            //get()だと動かないけど、first()なら何故か動く。なんで？
                            //->コレクションクラスだから。
        // dump($recruitments_collection);
        // array:2 [▼
        //         0 => Illuminate\Database\Eloquent\Collection {#1263 ▶}
        //         1 => Illuminate\Database\Eloquent\Collection {#1173 ▶}
        //         ]
        };
        
        //コレクションクラスのままではforeachでまわせないので、一旦first()を使ってモデルクラスに直す。
        
        // foreach($recruitments_collection as $recruitment)
        // {
        //     $recruitments[] = $recruitment->all();
        // }
        
        // dump($recruitments_collection);
        $recruitments = $query->paginate(20);
        
        // array:2 [▼
        //         0 => App\Models\Recruitment {#1105 ▶}
        //         1 => App\Models\Recruitment {#700 ▶}
        //         ]

        

        return view('recruitment.search')->with([
            "recruitments" => $recruitments,
            "search" => $search,
        ]);
    }

    public function postComment(Request $request,$recruitment_id)
    {   // コメントを取得
        $comment = $request->comment;
        // dd($comment); -> OK
        //　Commentテーブルにデータを保存
        $comment = new Comment;
		$comment->comment = $request->input('comment');
		$comment->user_id = Auth::user()->id;
		$comment->recruitment_id = $recruitment_id;
        
        // $comment->save();

        $user = User::find(Auth::user()->id);
        dd($user->recruitments->where('id',"$recruitment_id")->pivot->comment);


    }

}
