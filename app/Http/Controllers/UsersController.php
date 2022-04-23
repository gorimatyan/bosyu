<?php

namespace App\Http\Controllers;

use App\Models\Tag;
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
    public function show($user_name)
    {   
        $user = User::query()
                ->where('user_name' , $user_name)
                ->first();
        $recruitments = $user->hasRecruitments;
        
        $tags = $user->favoriteTags;
        foreach($tags as $tag)
        {   
            $favorite_tag_id = $tag->pivot->tag_id;
            $favorite_tags[] = Tag::find($favorite_tag_id);
        }
        return view('user.show',[
           "user" => $user,
           "recruitments" => $recruitments,
           "favorite_tags" => $favorite_tags,
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
    public function update(Request $request, $user_name)
    {   
        // バリデーションは一旦後回し
        //$this->validator($request->all())->validate();
        $login_user_id = Auth::user()->id;
        $updated_user_id = $request->input('id');
        $user = User::where('id' ,$login_user_id)->first();

        $user->nickname = $request->input('nickname');
        $user->user_name = $request->input('user_name');
        $user->self_introduction = $request->input('self_introduction');
        $user->email = $request->input('email');
        $user->email_status = $request->input('email_status');
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

        $updated_user = User::where('id' ,$updated_user_id)->first();
            // dd($updated_user);
            return redirect()->route('user.settingsMyPage');
        //   return view('user.settingsMyPage',[
        //         "user" => $updated_user,
        //     ]);
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

    public function settingsMyPage()
    {   
        // $login_user = Auth::user();
        
        return view('user.settingsMyPage')
        // ->with([
        //     "user" => $login_user,
        // ])
        ;

    }

}
