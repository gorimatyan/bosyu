@extends('layouts.app')
@section('content')
    <body>
        
        <div class="user_information">
            <div class="user">

            </div>
            <div class="self-introduction">
                {{ $user->name }}
            </div>
        </div>

        <article class="details_of_recruitment">
            <div class="recruitment_title">{{ $recruitment->title }}</div>
            <div class="discription"></div>
            <div class="comment_space"></div>
        </article>

    </body>
@endsection