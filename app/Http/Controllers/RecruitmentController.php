<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewNotice;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Tag;
use App\Models\UserEntry;
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
        $recruitment->requirement = $request->input('requirement');
        $recruitment->deadline = $request->input('deadline');

        // ユニークな募集IDをDBと照らし合わせて被りが出ないように取得
        for($id = uniqid(); DB::table('recruitments')->where('id', $id)->exists();)
        {
            $id = uniqid();
        }
            $recruitment->id = $id;
            $related_recruitment_id = $id; //下のif文で使用する募集idをsave前に取得（saveするとその後のidがなぜかid=0になるから)
            $recruitment->save();
            
            // タグ欄に入力されたタグを取得して配列にする
            $entered_tag = $request->input('tag');
            //1.全角スペースを半角スペースに変換
            $entered_tag = str_replace('　', ' ', $entered_tag);
            //2.前後のスペース削除（trimの対象は半角スペースのみなので半角スペースに変換後行う）
            $entered_tag = trim($entered_tag);
            //3.連続する半角スペースを半角スペースひとつに変換
            $entered_tag = preg_replace('/\s+/', ' ', $entered_tag);
            //半角スペースで分割して配列にする
            $tags = explode(' ',$entered_tag);

            
            $related_recruitment = Recruitment::where('id',$related_recruitment_id)
                                                ->first();
            foreach($tags as $tag)
            {   $checked_tag = Tag::where('tag',$tag)->first();

            // タグテーブルに入力されたタグが存在するならタグIDのみを取得しattach
            // 存在しないならタグを作成してからattach
                if(empty($checked_tag)){
                    // タグが保存されていない時
                    $new_tag = new Tag;
                    $new_tag->tag = $tag;
                    $new_tag->save();
                    
                    $related_recruitment->tags()->attach($new_tag->id);
                }
                else{
                    // 既にタグが保存されている時
                    $related_recruitment->tags()->attach($checked_tag->id);
                };
            };
            

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
        $count_comments = $recruitment->users->count();
        

        //　募集詳細のviewにルートパラメータから得た募集とそれに紐づくユーザー情報を取得
        return view('recruitment.show')->with([
            "recruitment" => $recruitment,
            "user" => $user,
            "comments" => $comments,
            "count_comments" => $count_comments
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
    public function destroy($recruitment_id)
    {
        $recruitment = Recruitment::query()->where('id' ,"$recruitment_id")->first();
        $recruitment->delete_flag = 1;
        // dd($recruitment);
        $recruitment->save();

        return redirect()->route('home');
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
        //分割して配列にする
        $keywords = explode(' ',$keyword);

        // タイトル本文検索とタグ検索をするためのキーワードをそれぞれ配列にする
        // $diff_tags[] = #付きのタグ検索キーワードの配列
        // $trimed_keyword = #を切り取ったキーワード
        // $tag_keywords[] = #を切り取ったキーワードの配列

        $diff_tags = [];
        foreach($keywords as $keyword)
        {
            if(str_starts_with($keyword,'#'))
            {   
                $diff_tags[] = $keyword;

                $trimed_keyword = trim($keyword,'#');
                $tag_keywords[] = $trimed_keyword;
            }
        }

        // $keywords配列からタグ検索に使用したキーワードを削除
        $search_keywords = array_diff($keywords,$diff_tags);

        // $recruitments = Recruitment::paginate(20);
        $recruitment_query = Recruitment::query();
        // まず検索に引っかかる募集のコレクションクラスを取得
        foreach($search_keywords as $keyword)
        {
            $recruitment_query->where(function($query) use($keyword)
            {
                $query->where('title' ,'like', "%{$keyword}%") 
                      ->orwhere('body' ,'like', "%{$keyword}%");
            })->where('delete_flag',0);
                            //サブクエリの中にはget()は要らん

        };
        
        if(!empty($tag_keywords))
        {   
            // whereHasを使って$recruitment_queryにタグの検索のクエリを追加する
            foreach($tag_keywords as $tag_keyword){
                $recruitments = $recruitment_query
                                ->whereHas('tags',function($query) use($tag_keyword)
                                {
                                    $query->where('tag',$tag_keyword);
                                })
                                ->with('tags')->get();
                                // dd($recruitment_query->toSql(),$recruitment_query->getBindings());
                                // dd($tag_keyword);
            };
            
        }else{
            
            $recruitments = $recruitment_query->with('tags')->get();
            // dd($recruitments);
        }

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
        
        $comment->save();
        //--------以上でコメント投稿処理は終わりでよさそう

        // $user = User::find(Auth::user()->id);
        // dd($user->recruitments);

        return redirect()->route('recruitment.show',[ "recruitment_id" => $recruitment_id]);


    }

    public function entry(Request $request,$recruitment_id)
    {
        //user_entriesテーブルのuse_idに参加者ID、recruitment_idに募集idを入れ、
        //同時にuser_entriesテーブルのmessageカラムにメッセージを保存
        $login_user = Auth::user();
        $entry = UserEntry::where('user_id',$login_user->id)
                ->where('recruitment_id',$recruitment_id)
                ->first();

        if(empty($entry))
        {
            User::find($login_user->id)
                ->userEntries()
                ->attach($recruitment_id,['message' => $request->message]);

                //new_noticesテーブルのto_userに募集者ID、from_userに参加者のidを入れる
            $new_notice = new NewNotice; 
            $recruiting_user = Recruitment::find($recruitment_id);

            $new_notice->to_user = $recruiting_user->user->id;
            $new_notice->from_user = $login_user->id;
            $new_notice->notice_type = 0; //0は募集の新規参加者のお知らせ
            $new_notice->recruitment_id = $recruitment_id;
            $new_notice->save();

            return redirect()->route('recruitment.show',[ "recruitment_id" => $recruitment_id]);
            
        }else{
            echo '既に参加申請をしています';
        }
        
        
    }

}
