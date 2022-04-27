@extends('layouts.no_list')
@section('content')
<body>
    <div class="container">
        <div class="recruitment-src__wrapper">
            <main class="recruitment-src__mainbar">
                <div class="search-input">
                    <form action="{{ route('recruitment.search') }}" method="GET" class="search-main">
                        @csrf
                        <input class="search-main__textbox" type="search" name='keyword' placeholder="検索ワードを入力" value="@if (isset($search)){{$search}}@endif">
                        <input type="submit" value="検索" class="bold search-button">
                    </form>
                </div>

                <!-- <div class="search-border-line"></div> -->

                <ul class="search-selector grayframe-shadow-none bold">
                    <li class="selector-recruitment selector-active"><a href="#">募集</a></li>
                    <li class="selector-waiting-people"><a href="#">待ち人</a></li>
                </ul>

                @foreach($recruitments as $recruitment)
                <div class="recruitments-col__list frame">
                    <div class="recruitment-col__top">
                        <header class="recruitment-col__top__header">
                            <a href="{{ route('user.show',['user_name' => $recruitment->user->user_name ]) }}"><img src="http://localhost:8000/storage/{{ $recruitment->user->image }}" alt="ユーザーアイコン" class="img-icon-size-mini"></a>
                            <a href="{{ route('user.show',['user_name' => $recruitment->user->user_name ]) }}">＠{{ $recruitment->user->user_name }}</a>
                            @if($recruitment->status == 0)
                            <div class="recruitment-status__active bold">募集中</div>
                            @else
                            <div class="recruitment-status__inactive bold">締切</div>
                            @endif
                        </header>
                        <h1 class="recruitment-col__title bold"><a href="{{ route('recruitment.show', ['recruitment_id' => $recruitment->id]) }}">{{ $recruitment->title }}</a></h1>
                        <h2 class="recruitment-col__body">{{ $recruitment->requirement }}</h2>
                    </div>

                    <div class="recruitment-col__bottom">
                        <div class="recruitment-col__content-left">
                            <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="tag-icon-small">
                            @foreach($recruitment->tags as $tag)
                            <a href="{{ route('tag.show',['tag' => $tag->tag ]) }}" class="fontsize-14px bold">{{ $tag->tag }}</a>&nbsp;
                            @endforeach
                        </div>
                        <div class="recruitment-col__content-right fontsize-12px">
                            投稿日：{{\Carbon\Carbon::parse($recruitment->created_at)->format('Y/m/d')}}
                        </div>
                    </div>
                </div>
                @endforeach
            </main>

            <div class="recruitment-src__sidebar">
                <div class="sidebar-trend">
                    <header class="bold">月間トレンド</header>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection

<!-- @foreach ($recruitments as $recruitment)
                <li class="search__recruitment">
                    <div class="search__recruitment__title">
                        <a href="{{ route('recruitment.show',['recruitment_id'=>$recruitment -> id]) }}" >{{ $recruitment -> title }}</a>
                    </div>
                    <div class="search__recruitment__body">
                        {{ $recruitment -> body }}
                    </div>
                </li>
                @endforeach -->