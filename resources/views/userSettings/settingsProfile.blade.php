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
                            <a href="#" class="color-gray active">公開プロフィール</a>
                            <a href="{{ route('user.showFavoriteTags') }}" class="color-gray">お気に入りタグ</a>
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

                    <div class="border-line__max mg-top-12px mg-bt-25px"></div>

                    <div class="border-frame__items">                    
                        <form action="{{ route('user.update',['user_name' => Auth::user()->user_name ]) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="input-box">
                                <p>ユーザーID</p>
                                <input class="grayframe width-max" type="text" name="user_name" value="{{ Auth::user()->user_name }}">
                            </div>
                            <div class="input-box">
                                <p>ニックネーム</p>
                                <input class="grayframe width-max" type="text" name="nickname" value="{{ Auth::user()->nickname }}">
                            </div>
                            <div class="input-box">
                                <p>自己紹介（400字以内）</p>
                                <textarea class="grayframe width-max" name="self_introduction">{{ Auth::user()->self_introduction }}</textarea>
                            </div>
                            <div class="input-box">
                                <p>メールアドレス</p>
                                <input class="grayframe width-max" type="email" name="email" value="{{ Auth::user()->email }}">
                                <div>
                                    <input type="hidden" name="email_status" value="0">
                                    @if( Auth::user()->email_status == 1 )
                                    <input type="checkbox" name="email_status" id="email_status" value="1" checked="true"><label for="email_status">メールアドレスを公開する</label>
                                    @else
                                    <input type="checkbox" name="email_status" id="email_status" value="1"><label for="email_status">メールアドレスを公開する</label>
                                    @endif
                                </div>
                            </div>
                            <div class="border-line__max mg-top-12px mg-bt-25px"></div>
                            <input type="submit" class="submit-button__orange bold" value="更新">
                        </form>
                        <form action="{{ route('user.destroy',[ 'id' => Auth::user()->id ]) }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf

                            <button type="submit">アカウント削除</button>
                        </form>
                    </div>
                </section>
                
            </div>
        </div>
    </div>
</body>
@endsection