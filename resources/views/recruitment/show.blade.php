@extends('layouts.app')
@section('content')
    <body>
        
        <div class="user-profile">
            <div class="user-profile__user">
                <img src="http://localhost:8000/storage/{{ $user->image }}" class="img-icon-size-medium">
                <a href="#" class="user-id">@ {{ $user->id }}</a>
                <a href="#" class="user-name">{{ $user->name }}</a>
            </div>

            <div class="user-profile__self-introduction">
                {{ $user->self_introduction }}
            </div>
        </div>

        <article class="recruitment-details">
        <div class="recruitment-details__recruitment-title">{{ $recruitment->id }}</div>
            <div class="recruitment-details__recruitment-title">{{ $recruitment->title }}</div>
            <div class="recruitment-details__discription">{{ $recruitment->body }}</div>
            <div class="recruitment-details__comment_space"></div>
        </article>
        
        <ul class="button-edit-delete">
            <li class="button-edit-delete__edit">
                <a href="{{ route('recruitment.edit' ,['recruitment_id' => $recruitment -> id]) }}">編集</a>
            </li>
            <li class="button-edit-delete__delete">
                <a href=""></a>
            </li>
        </ul>
        
        <div class="comments">
        @foreach($comments as $comment)
        {{ $comment->pivot->comment }}
        @endforeach 
            <form action="{{ route('recruitment.postComment',['recruitment_id' => $recruitment -> id]) }}" method="POST">
            @csrf
            <input type="text" name="comment" placeholder="コメントを書き込む">
            <input type="submit" value="送信">
            </form>
        </div>
    </body>
@endsection