<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header>
        
            <div class='header-start'>
                <a href="#"><h1>サービス名</h1></a>
                <form action="{{ route('recruitment.search') }}" method="GET">
                    @csrf
                    <input type="search" name='keyword' placeholder="募集を検索" value="@if (isset($search)){{$search}}@endif">
                    <input type="submit" value="検索">
                </form>
            </div>

            <ul class='header-end'>
                @if(Auth::guard('web')->check())

                                <li>
                                    <a class="header-end__user-info" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                            </ul>
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
        


    </header>


</body>
</html>