@extends('layouts.lists.app')

@section('content')
<div class="home__container">
    <div class="home__left-container">
        <div class="sidebar-trend">
            <section class="icon-heading">
                <div class="icon-heading__header">
                    <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="img-icon-size-mini">
                    <h2>月間トレンド</h2>
                </div>
                <div class="border-line__max mg-bt-20px"></div>
                <div class="icon-heading__items">
                    <ol class="icon-heading__items__column">
                    @foreach($trend_tags as $trend_tag)
                        <li><a href="{{ route('tag.show',[ 'tag' => $trend_tag->tag ]) }}">{{ $trend_tag->tag }}</a></li>
                        <div class="border-line__max__light mg-top-8px mg-bt-25px"></div>
                    @endforeach   
                    </ol>
                </div>
            </section>
        </div>
    </div>

    <div class="home__main">
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
    </div>

    <div class="home__right-container">
        <div class="sidebar__normal-item">
            <section class="icon-heading">
                <div class="icon-heading__header">
                    <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="img-icon-size-mini">
                    <h2>新着のお知らせ</h2>
                </div>
                <div class="border-line__max mg-bt-20px"></div>
                <div class="icon-heading__items">
                    @if($count_new_notices > 0)
                        <a href="#">新着のお知らせが{{ $count_new_notices }}件あります</a>
                    @else
                        新着のお知らせはありません
                    @endif
                </div>
            </section>
        </div>
        <div class="sidebar__management-notices">
            <section class="icon-heading">
                <div class="icon-heading__header">
                    <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="img-icon-size-mini">
                    <h2>運営からのお知らせ</h2>
                </div>
                <div class="border-line__max__gray mg-bt-20px"></div>
                <div class="icon-heading__items">
                    <div class="icon-heading__items__management-notice">
                        @foreach($management_notices as $management_notice)
                        {{ $management_notice->title }}
                        {{ $management_notice->updated_at->format("Y/m/d") }}
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
<!-- @foreach($users as $user)
        {{ $user->pivot->created_at }}
    @endforeach -->
