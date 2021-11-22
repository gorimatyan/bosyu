<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
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
        $user = $recruitment->user;

        //　募集詳細のviewにルートパラメータから得た募集とそれに紐づくユーザー情報を取得
        return view('recruitment.show')->with([
            "recruitment" => $recruitment,
            "user" => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $keyword = $request->keyword;

        //1.全角スペースを半角スペースに変換
        $keyword = str_replace('　', ' ', $keyword);
        //2.前後のスペース削除（trimの対象半角スペースのみなので半角スペースに変換後行う）
        $keyword = trim($keyword);
        //3.連続する半角スペースを半角スペースひとつに変換
        $keyword = preg_replace('/\s+/', ' ', $keyword);
        //分割
        $keywords = explode(' ',$keyword);

        foreach($keywords as $keyword)
        {
            $recruitments = Recruitment::where('title' ,'like', "%{$keyword}%")
                            ->orWhere('body' ,'like', "%{$keyword}%")
                            ->get();
        };
                    

        return view('recruitment.search')->with([
            "recruitments" => $recruitments,
        ]);
    }

}
