@extends('layouts.app')

@section('content')
<body>
    <form action="{{ route('user.update',[ 'id' => $user->id ]) }}" method="post">
        <input type="hidden" name="_method" value="PUT">
        @csrf

        <input type="text" name="id" value="{{ $user->id }}">
        <input type="text" name="name" value="{{ $user->name }}">
        <input type="text" name="self_introduction" value="{{ $user->self_introduction }}">


        <!-- @foreach($recruitments as $recruitment)
            {{ $recruitment->id }}
            {{ $recruitment->title }}
            {{ $recruitment->body }}
            {{ $recruitment->id }}
            {{ $recruitment->number_of_people }}
            {{ $recruitment->deadline }}
        @endforeach -->
        <button type="submit">更新</button>
    </form>

    <form action="{{ route('user.destroy',[ 'id' => $user->id ]) }}" method="post">
        <input type="hidden" name="_method" value="DELETE">
        @csrf

        <button type="submit">アカウント削除</button>
    </form>
</body>
@endsection