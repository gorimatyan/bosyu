@extends('layouts.lists.app')

@section('content')
<div class="container">
    @foreach($users as $user)
        {{ $user->pivot->created_at }}
    @endforeach
</div>
@endsection
