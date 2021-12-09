<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // たぶんユーザー一覧表示はそもそもいらない気がする
        // return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // RegisterControllerで作れるのでこれはいらない
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 同上
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $user = User::query()
                ->where('id' , $id)
                ->first();
        // dd($user);
        $recruitments = $user->hasRecruitments;
        // dd($recruitments);
        
        return view('user.show',[
           "user" => $user,
           "recruitments" => $recruitments,
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

        // 編集できるユーザーを限定する認可をミドルウェアで実装せねばならん。
        //

        $user = User::query()
                ->where('id' , $id)
                ->first();
        // dd($user);
        $recruitments = $user->hasRecruitments;
        // dd($recruitments);

        return view('user.edit',[
            "user" => $user,
            "recruitments" => $recruitments,
        ]);
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
        // バリデーションは一旦後回し
        //$this->validator($request->all())->validate();

        $user = User::query()->where('id' ,"$id")->first();

        // dd($user);
            //Recruitmentsテーブルのuser_idを更新する処理
        $user_hasRecruitments = $user->hasRecruitments;
        foreach($user_hasRecruitments as $user_hasRecruitment)
        {   
            $user_hasRecruitment->user_id = $request->input('id');
        };

            // Commentsテーブルのuser_idを更新する処理
        $user_ids_on_comment_table = $user->recruitments;
        foreach($user_ids_on_comment_table as $user_id_on_comment_table)
        {
            $user_id_on_comment_table->pivot->user_id =  $request->input('id');
            
        };

        $user->save();

            //　そしてログイン中のユーザー情報を更新する。これで更新してもログイン状態が解除されない 
        $user->name = $request->input('name');
        // $user->email = $request->input('email');
        $user->id = $request->input('id');
        $user->self_introduction = $request->input('self_introduction');
        // dd(Auth::user()->id);
        $user->save();
        

            // 消すな　imageに画像ファイルパスを保存する処理 
        // $originalImg = $request->file('image');

        // if(isset($originalImg)){
        //     $filePath = $originalImg->store('public');
        //     $user->image = str_replace('public/','', $filePath);
            
        // }else{
        //     $filePath = 'storage/defaultUserImg.jpg';
        //     $user->image = str_replace('storage/','', $filePath);
        // };
          
        //   $user->save();

          return redirect()->route('user.show',['id' => $user->id ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id' => ['required','string','min:8','max:16','unique:users'],
            'self_introduction' => ['required','string','max:1000'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $login_user_id = Auth::user()->id;
        $user = User::query()->where('id' ,"$login_user_id")->first();
        $user->delete_flag = 1;

        $user->save();
        
        Auth::logout();

        return redirect()->route('login');
    }
}
