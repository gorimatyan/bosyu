@extends('layouts.no_list')
@section('content')
<body>
    <div class='container'>
        <div class='row-container'>
                <div class="row-container__left frame">

                    <div class="user-profile__column mg-bt-70px mg-top-12px">
                        <img src="http://localhost:8000/storage/defaultUserImg.jpg" alt="ユーザー画像" class="mg-bt-12px img-icon-size-medium">
                        <p class="mg-bt-8px fontsize-14px">＠</p>
                        <p class="bold mg-bt-8px">{{ $searched_tag->tag }}</p>
                        <div class="register-fav-tag">

                                <button id="register-fav-tag-btn" type="submit" >お気に入りのタグにする</button>

                            <script>
                                const tag_btn = document.getElementById('register-fav-tag-btn');
                                tag_btn.addEventListener('click',()=>{
                                    
                                    const formData = new FormData();
                                    formData.append('tag',"{{ $searched_tag->tag }}")
                                    console.log(formData.get('tag'));
                                    fetch("{{ route('user.registerFavoriteTags') }}",{
                                        method: 'POST',
                                        body: formData,
                                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}, //Laravelの場合これが必要
                                    })
                                    .then((Response)=>{
                                        return console.log('成功しました');
                                    })
                                    .catch((error)=>{
                                        return console.log('失敗しました');
                                    })
                                })
                            </script>
                        </div>
                    </div>

                    <section class="icon-heading ">
                        <div class="icon-heading__header">
                            <img src="http://localhost:8000/storage/Info-white.jpg" alt="タグアイコン" class="img-icon-size-mini__square">
                            <p>タグ情報</p>
                        </div>

                        <div class="border-line__max mg-bt-20px"></div>
                        <div class="icon-heading__items">
                            <div class="icon-heading__items__user-info">
                                <p>募集中</p>
                                @if(!empty($active_recruitments))
                                <p>{{ $active_recruitments->count() }}件</p>
                                @else
                                <p>0件</p>
                                @endif
                            </div>
                            <div class="icon-heading__items__user-info">
                                <p>待ち人中</p>
                                <p>2件</p>
                            </div>
                            <div class="icon-heading__items__user-info">
                                <p>募集総数</p>
                                <p>{{ $all_recruitments->count() }}件</p>
                            </div>
                            <div class="icon-heading__items__user-info">
                                <p>待ち人総数</p>
                                <p>120件</p>
                            </div>
                        </div>
                    </section>


                </div>

            <div class="row-container__right frame">
                <ul class="label-selector">
                    <a href=""><li class="label-selector__item-active bg-color__brown">募集</li></a>
                    <a href=""><li class="label-selector__item">待ち人</li></a>
                </ul>

                <div class="border-line__brown__max mg-bt-8px"></div>

                <ul class="label-selector">
                    <a href=""><li class="label-selector__item-active bg-color__orange">募集中</li></a>
                    <a href=""><li class="label-selector__item">締切済</li></a>
                </ul>

                <div class="border-line__max__2px mg-bt-20px"></div>
                <div class="user-show__recruitment-list__container">
                    @if(!empty($active_recruitments))
                    @foreach($active_recruitments as $recruitment)
                        <div class="recruitments-col__list">
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
                                <h2 class="recruitment-col__body">{{ $recruitment->body }}</h2>
                            </div>

                            <div class="recruitment-col__bottom">
                                <div class="recruitment-col__content-left">
                                    <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="tag-icon-small">
                                    @foreach($recruitment->tags as $tag)
                                    <a href="{{ route('tag.show',[ 'tag' => $tag->tag ]) }}" class="fontsize-14px bold">{{ $tag->tag }}</a>&nbsp;
                                    @endforeach
                                </div>
                                <div class="recruitment-col__content-right fontsize-12px">
                                    投稿日：{{\Carbon\Carbon::parse($recruitment->created_at)->format('Y/m/d')}}
                                </div>
                            </div>
                        </div>
                    <div class="border-line__max__light mg-bt-20px"></div>
                    @endforeach
                    @else
                        <p class="bold font-color__gray mg-lf-8px">募集がありません</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</body>
@endsection