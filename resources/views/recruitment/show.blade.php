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
            <div class="recruitment-details__recruitment-title">{{ $recruitment->title }}</div>
            <div class="recruitment-details__discription">{{ $recruitment->body }}</div>
            <div class="recruitment-details__comment_space"></div>
        </article>

    </body>
@endsection