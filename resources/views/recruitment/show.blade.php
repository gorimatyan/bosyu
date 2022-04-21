@extends('layouts.no_lists')
@section('content')
<body>
    <div class="container recrutiment-show__container">
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
                            <div class="recruitment-details__text">{{ $recruitment->body }}</div>
                        </div>
                        <div class="recruitment-details__requirements">
                            <div class="recruitment-details__requirements__title bold">募集要件</div>
                            <div class="recruitment-details__text">ふにゃふにゃ</div>
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
                    <div class="comments-title bold">{{ $count_comments }}件のコメント</div>
                    <div class="border-line__max mg-bt-16px"></div>
                    <ol>
                        @foreach($comments as $comment)
                            <li>
                                <div class="comment-user">
                                    <img src="http://localhost:8000/storage/{{ $user->image }}" alt="" class="img-icon-size-mini">
                                    <a href="#">{{ $comment->pivot->user_id }}</a>
                                </div>
                            </li>
                            
                            
                            <p class="comment">{{ $comment->pivot->comment }}</p>

                            <div class="border-line__max__light"></div>
                        @endforeach 
                    </ol>
                    <form action="{{ route('recruitment.postComment',['recruitment_id' => $recruitment -> id]) }}" class="comment-to-recruitment" method="POST">
                        @csrf
                        <textarea type="text" class="grayframe" name="comment" placeholder="コメントを書き込む"></textarea>
                        <input type="submit" class="submit-button" value="送信">
                    </form>
                </div>
            </main>

            <div class="recruitment-details__sidebar">
                わああああ
            </div>
        </div>
    </div>
    

    <div class="footer__entry">
        <input type="checkbox" id="entry">
        <label for="entry">
            <p>参加申請</p>
        </label>

        <div class="message-form__input">
            <div class="message-form__header">
                <h4>募集者へのメッセージ</h4>
                <label for="entry" class="fontsize-24px">×</label>
            </div>

            <div class="border-line__max"></div>
            <form action="{{ route('recruitment.entry', ['recruitment_id' => $recruitment -> id]) }}" class="message-form__textarea" method="POST">
                @csrf
                <textarea name="message" class="grayframe" placeholder="よろしくお願いします！"></textarea>
                <input type="submit" class="submit-button" value="申請する">
            </form>
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