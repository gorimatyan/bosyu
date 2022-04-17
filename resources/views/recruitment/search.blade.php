@extends('layouts.no_lists')
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

                <ul class="search-selector grayframe bold">
                    <li class="selector-recruitment selector-active"><a href="#">募集</a></li>
                    <li class="selector-waiting-people"><a href="#">待ち人</a></li>
                </ul>

                @foreach($recruitments as $recruitment)
                <div class="recruitments-src__lists frame">
                    <section class="recruitment-src">
                        <div class="recruitment-src__top">
                            <header class="recruitment-src__top__header">
                                <a href="#"><img src="http://localhost:8000/storage/{{ $recruitment->user->image }}" alt="ユーザーアイコン" class="img-icon-size-mini"></a>
                                <a href="#" class="recruitment-src__user-name">＠{{ $recruitment->user->id }}</a>
                                <div class="recruitment-status bold">募集中</div>
                            </header>
                            <h1 class="recruitment-src__title bold"><a href="{{ route('recruitment.show', ['recruitment_id' => $recruitment->id]) }}">{{ $recruitment->title }}</a></h1>
                            <div class="recruitment-src__body">{{ $recruitment->body }}</div>
                        </div>

                        <div class="recruitmen-src__bottom">
                            <div class="recruitment-src__content-left">
                                <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="tag-icon-small">
                                    @foreach($recruitment->tags as $tags)
                                        <a href="#" class="fontsize-14px bold">{{ $tags->tag }}</a>&nbsp;
                                    @endforeach
                            </div>
                            <div class="recruitment-src__content-right fontsize-12px">
                                投稿日：{{ $recruitment->created_at}}
                            </div>
                        </div>

                    </section>
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