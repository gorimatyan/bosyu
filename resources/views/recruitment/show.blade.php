@extends('layouts.no_lists')
@section('content')
    <body>
        <div class="container">
            <div class="recruitment-details">
                <main class="recruitment-details__main">
                    <div class="frame">
                        <header class="recruitment-details__header">
                            <div class="recruitment-details__user-profile">
                                <img src="http://localhost:8000/storage/{{ $user->image }}" class="img-icon-size-small">
                                <div class="recruitment-details__user-profile__id">
                                        <a href="#" class="">＠{{ $user->id }}</a>
                                        <a href="#" class="">{{ $user->name }}</a>
                                </div>
                            </div>

                            <h1 class="recruitment-details__recruitment-title">{{ $recruitment->title }}</h1>
                            <div class="recruitment-details__tags">
                                <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="tag-icon-small">
                                <a href="#" class="fontsize-14px bold">タグ名</a>
                            </div>
                        </header>

                        <section class="recruitment-details__details">
                            <div class="recruitment-details__body">
                                <div class="recruitment-details__body__title bold">概要</div>
                                <div class="recruitment-details__text">ふにゃふにゃ</div>
                            </div>
                            <div class="recruitment-details__requirements">
                                <div class="recruitment-details__requirements__title bold">募集要件</div>
                                <div class="recruitment-details__text">あああああああああ</div>
                            </div>
                        </section>
                    </div>
                    @if(Auth::user()->id === $user->id )
                    <ul class="button-edit-delete">
                        <li class="button-edit-delete__edit">
                            <a href="{{ route('recruitment.edit' ,['recruitment_id' => $recruitment -> id]) }}">編集</a>
                        </li>
                        <li class="button-edit-delete__delete">
                            <form action="{{ route('recruitment.destroy',['recruitment_id' => $recruitment->id]) }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                            
                                <button type="submit">投稿削除</button>
                            </form>
                        </li>
                    </ul>
                    @endif
                    
                    <div class="comments">
                        <div class="comments-title bold">3件のコメント</div>
                        <div class="comments__border-line"></div>
                        <ol>
                            @foreach($comments as $comment)
                                <li>
                                    <div class="comment-user">
                                        <img src="http://localhost:8000/storage/{{ $user->image }}" alt="" class="img-icon-size-mini">
                                        <a href="#">{{ $comment->pivot->user_id }}</a>
                                    </div>
                                </li>
                                
                                
                                <p class="comment">{{ $comment->pivot->comment }}</p>

                                <div class="comments__border-line__light"></div>
                            @endforeach 
                        </ol>
                        <form action="{{ route('recruitment.postComment',['recruitment_id' => $recruitment -> id]) }}" method="POST">
                            @csrf
                            <input type="text" name="comment" placeholder="コメントを書き込む">
                            <input type="submit" value="送信">
                        </form>
                    </div>
                </main>

                <div class="recruitment-details__sidebar">
                    わああああ
                </div>
            </div>
        </div>
    </body>
@endsection

<!-- <div class="comments">
        @foreach($comments as $comment)
        {{ $comment->pivot->user_id }} 
        {{ $comment->pivot->comment }} <br>
        @endforeach 
            <form action="{{ route('recruitment.postComment',['recruitment_id' => $recruitment -> id]) }}" method="POST">
            @csrf
            <input type="text" name="comment" placeholder="コメントを書き込む">
            <input type="submit" value="送信">
            </form>
        </div> -->