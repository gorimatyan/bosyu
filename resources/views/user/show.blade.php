@extends('layouts.app')

@section('content')
<body>
    <div class='container'>
        <div class='left-container'>
            <img src='http://localhost:8000/storage/{{ $user->image }}' alt='ユーザー画像' >

            <ul class='tag'>
                <li></li>
            </ul>

            <div class='user_discription'>

            </div>
        <a href="{{ route('user.edit',['id' => $user->id ]) }}">
            {{ $user->id }}
            {{ $user->name }}
        </a>
        @if(Auth::user()->id === $user->id )
        <a href="{{ route('user.edit',['id' => $user->id ]) }}">
            編集
        </a>
        @endif
        </div>
        <h2>募集一覧</h2>
        @foreach($recruitments as $recruitment)
        {{ $recruitment->id }}
        {{ $recruitment->title }}
        {{ $recruitment->body }} <br>
        @endforeach
        <div class='right-container'>
            <div class='recruitment'>
                <h3></h3>
                <p></p>
            </div>    
        </div>
    </div>
</body>
@endsection