@extends('layouts.lists.app')

@section('content')
<div class="container">
    <div class="home__container">
        <div class="home__left-container">
            <div class="sidebar-trend frame">
                <header class="bold">月間トレンド</header>
                @foreach($trend_tags as $trend_tag)
                    #{{ $trend_tag->tag }}
                @endforeach
            </div>
        </div>

        <div class="home__main">

        </div>

        <div class="home__right-sidebar">
            <div class="sidebar-new-notices frame">
                <header class="bold">新着のお知らせ</header>
                <div class="notice-list">
                    @if($count_new_notices > 0)
                        <a href="#">新着のお知らせが{{ $count_new_notices }}件あります</a>
                    @else
                        新着のお知らせはありません
                    @endif
                </div>
            </div>
            <div class="sidebar-management-notices grayframe">
                <header class="bold">運営からのお知らせ</header>
                @foreach($management_notices as $management_notice)
                    {{ $management_notice->title }}
                    {{ $management_notice->updated_at->format("Y/m/d") }}
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
<!-- @foreach($users as $user)
        {{ $user->pivot->created_at }}
    @endforeach -->
