<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js\jquery-3.6.0.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header id="lists-header">
        <div class="lists-header__top">
            <div class='lists-header__start'>
                <a href="#"><h1 id="service-logo">サービス名</h1></a>
                <form action="{{ route('recruitment.search') }}" method="GET">
                    @csrf
                    <input class="search-textbox" type="search" name='keyword' placeholder="募集を検索" value="@if (isset($search)){{$search}}@endif">
                    <input type="submit" value="検索">
                </form>
            </div>

            <ul class='lists-header__end'>
                @if(Auth::guard('web')->check())
                <div class="dropdown">


                <a class="dropdown__btn" id="dropdown__btn">
                
                </a>
  <div class="dropdown__body">
    <ul class="dropdown__list">
      <li class="dropdown__item"><a href="https://www.google.com/" class="dropdown__item-link">Google</a></li>
      <li class="dropdown__item"><a href="https://www.yahoo.co.jp/" class="dropdown__item-link">Yahoo! JAPAN</a></li>
      <li class="dropdown__item"><a href="https://www.bing.com/" class="dropdown__item-link">Bing</a></li>
    </ul>
  </div>
</div>
                                <li>
                                    <a class="current-login-user" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img src="http://localhost:8000/storage/{{ Auth::user()->image }}" class="img-icon-size-small">
                                        <div class="user-name">{{ Auth::guard('web')->user()->name }}</div>                                 
                                    </a>
                                </li>
                                <li>
                                    <div class="header-end__logout" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            ログアウト
                                        </a>

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

        <div class="lists-header__bottom">

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