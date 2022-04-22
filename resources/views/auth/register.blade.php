@extends('layouts.login')

@section('content')
<div class="container">
    <div class="content-center">
        <div class="card">
            <div class="card-header">
                <h2 class="fontsize-36px bold">新規登録</h2>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('userRegister') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- <div class="form-group row py-2">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('氏名') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="register-form">
                            <label for="email" class="textbox-email fontsize-16px bold">メールアドレス</label>
                            <div class="textbox">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        <div class="register-form">
                            <label for="password" class="textbox-password fontsize-16px bold">パスワード</label>
                                <div class="textbox">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                </div>
                        </div>
                        
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        <div class="register-form">
                            <label for="password-confirm" class="password-confirm fontsize-16px bold">{{ __('パスワードの確認') }}</label>
                                <div class="textbox">
                                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                                </div>
                        </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        <div class="register-form">
                            <label for="id" class="textbox-password fontsize-16px bold">{{ __('ユーザーID') }}</label>
                                <div class="textbox">
                                    <input id="id" type="text" class="@error('id') is-invalid @enderror" name="user_name" value="{{ old('id') }}" required autocomplete="id" autofocus>
                                </div>
                        </div>                     
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>



                    <!-- <div class="form-group">
                        <label for="email" class="col-md-4">{{ __('メールアドレス') }}</label>

                        <div class="">
                            <input id="email" type="email" class="textbox @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4">{{ __('パスワード') }}</label>

                        <div class="">
                            <input id="password" type="password" class="textbox @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4">{{ __('パスワードの確認') }}</label>

                        <div class="">
                            <input id="password-confirm" type="password" class="textbox" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id" class="col-md-4">{{ __('ID') }}</label>

                        <div class="">
                            <input id="id" type="text" class="textbox @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" required autocomplete="id" autofocus>

                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> -->
<!-- 
                    <div class="form-group">
                        <label for="image" class="col-md-4 col-form-label text-md-right img-fluid">{{ __('写真をアップロード') }}</label>

                        <div class="">
                            <input id="image" type="file" class="textbox @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="image" autofocus accept=".png, .jpeg, .jpg">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <img src="http://localhost:8000/storage/defaultUserImg.jpg" class="col-2 icon-min-size img-icon" alt="初期アイコン" title="初期アイコン"> -->

                    <!-- <div class="form-group row py-2">
                        <label for="user_description" class="col-md-4 col-form-label text-md-right">{{ __('自己紹介') }}</label>

                        <div class="">
                            <input id="user_description" type="text" class="textbox @error('user_description') is-invalid @enderror" name="user_description" value="{{ old('user_description') }}" required autocomplete="user_description" autofocus>

                            @error('user_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> -->
                    


                    <div class="register-btn-wrapper">
                        <button type="submit" class="register-btn bold">
                            登録
                        </button>
                    </div>
                    <div class="content-center">
                        <div class="login-border-line"> </div>
                    </div>
                    <div class="sns-login">
                        <a class="LINE-login" href="">LINEで新規登録</a>
                        <a class="Twitter-login" href="">Twitterで新規登録</a>
                    </div>



                </form>
            </div>
        </div>
    </div>
</div>
@endsection
