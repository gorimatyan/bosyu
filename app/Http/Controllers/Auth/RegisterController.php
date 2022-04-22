<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UploadImage;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    protected function userRegister(Request $request){
        $this->validator($request->all())->validate();

        //event(new Registered($user = $this->create($request->all())));
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'id' => $data['id'],
        //     'user_description' => $data['user_description'],
        // ]);
        
        $user = new User;
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->user_name = $request->input('user_name');

            // imageに画像ファイルパスを保存する処理 
        // $originalImg = $request->file('image');

        if(isset($originalImg)){
            // $filePath = $originalImg->store('public');

            // return User::create([
            //     'image' => str_replace('public/','', $filePath)
            // ]);

            $filePath = $originalImg->store('public');
            $user->image = str_replace('public/','', $filePath);
            
        }else{
            // $filePath = '/storage/defaultUserImg.jpg';
            
            // return User::create([
            //     'image' => str_replace('/storage','', $filePath)
            // ]);
            
            $filePath = 'storage/defaultUserImg.jpg';
            $user->image = str_replace('storage/','', $filePath);
        };
          
          $user->save();
           

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());

    }
    

    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_name' => ['required','string','min:8','max:16','unique:users'],
            // 'user_description' => ['required','string','max:1000'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {   
        // 画像以外をDBに保存する処理
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id' => $data['id'],
            'user_description' => $data['user_description'],
        ]);
        


        // $user->name = $request->input('name');
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->id = $request->id;
        // $user->user_description = $request->user_description;

            // imageに画像ファイルパスを保存する処理
            $user = new User;
            $request = new Request;
            
            $originalImg = $request->input('image');
        
            // 画像があれば
        if(isset($originalImg)){
            $filePath = $originalImg->store('public');

            return User::create([
                'image' => str_replace('public/','', $filePath)
            ]);

            // $filePath = $originalImg->store('public');
            // $user->image = str_replace('public/','', $filePath);

            // 画像がないなら
        }else{
            $filePath = 'storage/defaultUserImg.jpg';
            $data['image'] = str_replace('storage/','', $filePath);
            
            return User::create([
                'image' => $data['image'],
            ]);
            
            // $filePath = '/storage/defaultUserImg.jpg';
            // $user->image = str_replace('/storage','', $filePath);
        };

            

            
            
        

        
        
        

    }
}
