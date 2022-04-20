@extends('layouts.no_lists')

            <!-- <img src='http://localhost:8000/storage/{{ $user->image }}' alt='ユーザー画像' >

            <ul class='tag'>
                <li></li>
            </ul>

            <div class='user_discription'>

            </div>
        <a href="{{ route('user.edit',['id' => $user->id ]) }}">
            {{ $user->id }}
            {{ $user->name }}
        </a>
        @if(Auth::user()->id === $user->id )
        <a href="{{ route('user.edit',['id' => $user->id ]) }}">
            編集
        </a>
        @endif
        </div>
        <h2>募集一覧</h2>
        @foreach($recruitments as $recruitment)
        {{ $recruitment->id }}
        {{ $recruitment->title }}
        {{ $recruitment->body }} <br>
        @endforeach
        <div class='right-container'>
            <div class='recruitment'>
                <h3></h3>
                <p></p>
            </div>     -->
@section('content')
<body>
    <div class='container'>
        <div class='user-show__container'>
                <div class="user-show__left-container frame">

                    <div class="user-profile__column mg-bt-50px mg-top-12px">
                        <img src="http://localhost:8000/storage/defaultUserImg.jpg" alt="ユーザー画像" class="mg-bt-12px img-icon-size-medium">
                        <p class="mg-bt-8px fontsize-14px">＠ユーザーID</p>
                        <p class="bold">ユーザー名</p>
                    </div>


                    <section class="user-profile">
                        <div class="user-profile__header">
                            <img src="http://localhost:8000/storage/defaultUserImg.jpg" alt="タグアイコン" class="img-icon-size-mini">
                            <p>自己紹介</p>
                        </div>
                        <div class="border-line__max mg-bt-20px"></div>
                        <div class="user-profile__items">
                            <p class="color-gray">プロフィールですオラオラオラオラオラオラオラオラオラオラオラオラオラウオァーァーオラオラオラ</p>
                        </div>
                    </section>


                    <section class="user-profile ">
                        <div class="user-profile__header">
                            <img src="http://localhost:8000/storage/Info-white.jpg" alt="タグアイコン" class="img-icon-size-mini">
                            <p>ユーザー情報</p>
                        </div>
                        <div class="border-line__max mg-bt-20px"></div>
                        <div class="user-profile__items">
                            <div class="user-profile__items__user-info">
                                <p>募集中</p>
                                <p>1件</p>
                            </div>
                            <div class="user-profile__items__user-info">
                                <p>待ち人中</p>
                                <p>2件</p>
                            </div>
                            <div class="user-profile__items__user-info">
                                <p>総ログイン日数</p>
                                <p>100日</p>
                            </div>
                            <div class="user-profile__items__user-info">
                                <p>参加した募集</p>
                                <p>5件</p>
                            </div>
                        </div>
                    </section>


                    <section class="user-profile">
                        <div class="user-profile__header">
                            <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="img-icon-size-mini">
                            <p>お気に入りタグ</p>
                        </div>
                        <div class="border-line__max mg-bt-20px"></div>
                        <div class="user-profile__items">
                        <!-- @foreach($recruitment->tags as $tags) -->
                                <a href="#" class="fontsize-12px bold">プログラミング</a>&nbsp;
                        <!-- @endforeach -->    
                        </div>
                    </section>


                </div>

            <div class="user-show__right-container frame">
                <ul class="label-selector">
                    <li class="label-selector__item">募集</li>
                    <li class="label-selector__item-active bg-color__brown">待ち人</li>
                    <li class="label-selector__item">コメント</li>
                </ul>

                <div class="border-line__brown__max mg-bt-8px"></div>

                <ul class="label-selector">
                    <li class="label-selector__item-active bg-color__orange">募集中</li>
                    <li class="label-selector__item">締切済</li>
                </ul>

                <div class="border-line__max__2px mg-bt-20px"></div>
                <div class="user-show__recruitment-list__container">
                    @foreach($recruitments as $recruitment)
                        <div class="recruitments-col__lists">
                            <div class="recruitment-col__top">
                                <header class="recruitment-col__top__header">
                                    <a href="{{ route('user.show',['id' => $recruitment->user->id ]) }}"><img src="http://localhost:8000/storage/{{ $recruitment->user->image }}" alt="ユーザーアイコン" class="img-icon-size-mini"></a>
                                    <a href="{{ route('user.show',['id' => $recruitment->user->id ]) }}">＠{{ $recruitment->user->id }}</a>
                                    <div class="recruitment-status bold">募集中</div>
                                </header>
                                <h1 class="recruitment-col__title bold"><a href="{{ route('recruitment.show', ['recruitment_id' => $recruitment->id]) }}">{{ $recruitment->title }}</a></h1>
                                <h2 class="recruitment-col__body">{{ $recruitment->body }}</h2>
                            </div>

                            <div class="recruitmen-col__bottom">
                                <div class="recruitment-col__content-left">
                                    <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="tag-icon-small">
                                    @foreach($recruitment->tags as $tags)
                                    <a href="#" class="fontsize-14px bold">{{ $tags->tag }}</a>&nbsp;
                                    @endforeach
                                </div>
                                <div class="recruitment-col__content-right fontsize-12px">
                                    投稿日：{{\Carbon\Carbon::parse($recruitment->created_at)->format('Y/m/d')}}
                                </div>
                            </div>
                        </div>
                    <div class="border-line__max__light mg-bt-20px"></div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</body>
@endsection

