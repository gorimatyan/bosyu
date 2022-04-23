@extends('layouts.no_list')
@section('content')
<body>
    <div class='container'>
        <div class='row-container'>
            <div class="row-container__left no-border-frame">
                <section class="icon-heading">
                    <div class="icon-heading__header">
                        <img src="http://localhost:8000/storage/defaultUserImg.jpg" alt="タグアイコン" class="img-icon-size-mini">
                        <p>設定</p>
                    </div>
                    <div class="border-line__max mg-bt-20px"></div>
                    <div class="icon-heading__items">
                        <div class="setting-menu">
                            <a href="#" class="color-gray">公開プロフィール</a>
                            <a href="{{ route('user.showFavoriteTags') }}" class="color-gray active">お気に入りタグ</a>
                            <a href="#" class="color-gray">パスワードの変更</a>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row-container__right frame">
                <section class="border-frame__content">
                    <div class="border-frame__header">
                        お気に入りタグの設定
                    </div>

                    <div class="border-line__max mg-top-12px mg-bt-25px"></div>

                    <div class="border-frame__items">                    
                        <form action="{{ route('user.updateFavoriteTags') }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="input-box">
                                <div class="checkboxes">
                                @foreach($tags as $tag)
                                    <input type="checkbox" checked="true" name="updateTags[]" id="{{ $tag->id }}" value="{{ $tag->id }}"><label for="{{ $tag->id }}">{{ $tag->tag }} </label>
                                @endforeach
                                </div>
                            </div>
                            
                            <div class="border-line__max mg-top-12px mg-bt-25px"></div>
                            <input type="submit" class="submit-button__orange bold" value="更新">
                        </form>
                    </div>
                </section>
                
            </div>
        </div>
    </div>
</body>
@endsection