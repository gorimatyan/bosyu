@extends('layouts.login')

@section('content')
<div class="container">
    <div class="login-frame">
        <!-- <div class="frame"> -->
            <div class="content-center ">
                <div class="card">
                    
                    <div class="card-header bold">
                        <h2 class="fontsize-36px">ログイン</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="login-forms">
                                <div class="login-form">
                                    <label for="email" class="textbox-email fontsize-16px bold">メールアドレス</label>
                                    <div class="textbox">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                        @error('email')
                                            <span class="login-error fontsize-16px" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                </div>

                                <div class="login-form">
                                    <label for="password" class="textbox-password fontsize-16px bold">パスワード</label>
                                        <div class="textbox">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        </div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                                    <div class="login-btn-wrapper">
                                        <button type="submit" class="login-btn bold">
                                            ログイン
                                        </button>
                                    </div>
                            <div class="login-help">
                                    @if (Route::has('password.request'))
                                        <p>パスワードを忘れた方は
                                            <a href="{{ route('password.request') }}" class="bold">
                                                こちら
                                            </a>
                                            </p>
                                    @endif
                                        <p>新規登録は
                                            <a href="" class="bold">
                                                こちら
                                            </a>
                                        </p>
                                    </div>

                            <div class="content-center">
                                <div class="border-line"> </div>
                            </div>

                            <div class="sns-login">
                                <a class="LINE-login" href="">LINEでログイン</a>
                                <a class="Twitter-login" href="">Twitterでログイン</a>
                            </div>
                            <!-- <div class="">
                                <div class="">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            次回以降もログイン状態を維持する
                                        </label>
                                    </div>
                                </div>
                            </div> -->

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
