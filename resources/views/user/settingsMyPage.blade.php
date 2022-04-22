@extends('layouts.no_list')
@section('content')
<body>
    <div class='container'>
        <div class='user-show__container'>
            <div class="row-container__left no-border-frame">
                <section class="icon-heading">
                    <div class="icon-heading__header">
                        <img src="http://localhost:8000/storage/defaultUserImg.jpg" alt="タグアイコン" class="img-icon-size-mini">
                        <p>設定</p>
                    </div>
                    <div class="border-line__max mg-bt-20px"></div>
                    <div class="icon-heading__items">
                        <div class="setting-menu">
                            <a href="#" class="color-gray active">公開プロフィール</a>
                            <a href="#" class="color-gray">お気に入りタグ</a>
                            <a href="#" class="color-gray">パスワードの変更</a>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row-container__right frame">
                <section class="border-frame__content">
                    <div class="border-frame__header">
                        公開プロフィール設定
                    </div>

                    <div class="border-line__max mg-top-12px"></div>

                    <div class="border-frame__items">                    
                        <form action="{{ route('user.update',['id' => Auth::user()->id ]) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="input-box">
                                <p>ユーザーID</p>
                                <input class="grayframe width-max" type="text" name="id" value="{{ Auth::user()->id }}">
                            </div>
                            <div class="input-box">
                                <p>ニックネーム</p>
                                <textarea class="grayframe width-max" type="text" name="name">{{ Auth::user()->name }}</textarea>
                            </div>
                            <div class="input-box">
                                <p>自己紹介（400字以内）</p>
                                <textarea class="grayframe width-max" name="self_introduction">{{ Auth::user()->self_introduction }}</textarea>
                            </div>
                            <div class="input-box">
                                <p>メールアドレス</p>
                                <input class="grayframe width-max" type="email" name="email" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="recruitment-create__border-line"></div>
                            <input type="submit" class="submit-button__orange bold" value="更新">
                        </form>
                    </div>
                </section>
                
            </div>
        </div>
    </div>
</body>
@endsection