@extends('layouts.lists.app')

@section('content')
<div class="home__container">
    <div class="home__left-container">
        <div class="sidebar__normal-item mg-bt-20px">
            <section class="icon-heading">
                <div class="icon-heading__header">
                    <img src="http://localhost:8000/storage/Notice.png" alt="タグアイコン" class="img-icon-size-mini">
                    <h2>新着のお知らせ</h2>
                </div>
                <div class="border-line__max mg-bt-20px"></div>
                <div class="icon-heading__items__small">
                    @if($count_new_notices > 0)
                        <a href="#" class="hover__underline ">新着のお知らせが{{ $count_new_notices }}件あります</a>
                    @else
                        新着のお知らせはありません
                    @endif
                </div>
            </section>
        </div>
        <div class="sidebar__normal-item mg-bt-20px">
            <section class="icon-heading">
                <div class="icon-heading__header">
                    <img src="http://localhost:8000/storage/Management.png" alt="タグアイコン" class="img-icon-size-mini__square">
                    <h2>運営からのお知らせ</h2>
                </div>
                <div class="border-line__max__gray mg-bt-20px"></div>
                <div class="icon-heading__items__small">
                    <div class="icon-heading__items__management-notice">
                        @foreach($management_notices as $management_notice)
                        <p class="mg-bt-8px">{{ $management_notice->updated_at->format("Y/m/d") }}</p>
                        <a href="" class="hover__underline">{{ $management_notice->title }}</a>
                        
                        @endforeach
                        <div class="border-line__max__light-gray mg-top-20px mg-bt-8px"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="home__main">
        <div class="notice-for-user__home grayframe fontsize-16px">
            <p class="mg-bt-12px">おすすめではお気に入りに登録したタグが付いた投稿が表示されます。</p>
            <a href="" class="hover__underline bold">お気に入りタグを設定する</a>
        </div>
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
    <div class="sidebar-trend">
            <section class="icon-heading">
                <div class="icon-heading__header">
                    <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="img-icon-size-mini__square">
                    <h2>月間トレンド</h2>
                </div>
                <div class="border-line__max mg-bt-20px"></div>
                <div class="icon-heading__items__small">
                    <div class="tag-ranking">
                    <?php $i = 0; ?>
                    @foreach($trend_tags as $trend_tag)
                    <?php $i++; ?>
                        <a href="{{ route('tag.show',[ 'tag' => $trend_tag->tag ]) }}">
                            <div class="tag-ranking__content">
                                <div class="tag-ranking__left">
                                    <span>{{ $i }}位</span>
                                    <p>#{{ $trend_tag->tag }}</p>
                                </div> 
                                <div>{{ app\Models\Tag::find($trend_tag->tag_id)->recruitments()->where('recruitments.delete_flag' , 0)->count() }}投稿</div>
                            </div>
                        </a>
                    
                        <div class="border-line__max__light mg-top-4px mg-bt-20px"></div>

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

