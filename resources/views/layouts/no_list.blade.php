<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header id="no-lists-header">
    <div class="lists-header__top">
            <div class='lists-header__start'>
                <a href="{{ route('home') }}"><h3 id="service-logo">サービス名</h3></a>
                <form action="{{ route('recruitment.search') }}" method="GET">
                    @csrf
                    <input class="search-textbox" type="search" name='keyword' placeholder="募集を検索" value="@if (isset($search)){{$search}}@endif">
                    <input type="submit" value="検索">
                </form>
            </div>

            <ul class='lists-header__end'>
                @if(Auth::guard('web')->check())
                <li>
                    <div class="dropdown">
                        <a id="dropdown__btn" class="dropdown__btn" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="current-login-user">                        
                                <img src="http://localhost:8000/storage/{{ Auth::user()->image }}" class="img-icon-size-small">
                                @if(isset(Auth::guard('web')->user()->nickname))
                                    <div class="user-name">{{ Auth::guard('web')->user()->nickname }}</div>
                                @else
                                    <div class="user-name">{{ Auth::guard('web')->user()->user_name }}</div>
                                @endif
                            </div>                               
                        </a>
                        <div class="dropdown__body">
                            <ul class="dropdown__list">
                                <li class="dropdown__item">
                                    <a class="dropdown__item-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>
                                </li>
                                <li class="dropdown__item"><a href="{{ route('recruitment.create') }}" class="dropdown__item-link">募集をする</a></li>
                                <li class="dropdown__item"><a href="https://www.bing.com/" class="dropdown__item-link">Bing</a></li>
                            </ul>
                        </div>
                    </div>  
                </li>
                <li>
                    <div class="header-end__logout" aria-labelledby="navbarDropdown">


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @else
                <li>
                        <a href="{{ route('register') }}">ユーザー登録</a>
                </li>
                <li>
                        <a href="{{ route('login') }}">ログイン</a>
                </li>
            </ul>
                @endif
        </div>
        <script>

            document.addEventListener('DOMContentLoaded', function() { // HTML解析が終わったら
                const btn = document.getElementById('dropdown__btn'); // ボタンをidで取得
                    if(btn) { // ボタンが存在しないときにエラーになるのを回避
                        btn.addEventListener('click', function(){ //ボタンがクリックされたら
                        this.classList.toggle('is-open'); // is-openを付加する
                        });
                }
            });
        </script>
    </header>
    @yield('content')   
</body>
</html>