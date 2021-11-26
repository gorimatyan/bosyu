@extends('layouts.app')
@section('content')
<body>
<main>
        <form action="{{ route('recruitment.update') }}" method="POST">
            @csrf
            @method("PUT")
            <p>
            <label for="title">募集名</label>
            <input type="text" name="title" id="title">
            </p>
            <p>
            <label for="number_of_people">人数</label>
            <input type="text" name="number_of_people" id="number_of_people">
            </p>
            <p>
            <label for="body">説明</label>
            <input type="text" name="body" id="body">
            </p>
            <p>
            <label for="deadline">募集〆切日</label>
            <input type="date" name="deadline" id="deadline">
            </p>
            <!-- <p>
            <label for="tag">タグ</label>
            <input type="text" name="tag" id="tag">
            </p> -->
            <input type="submit" value="送信">
        </form>
        
    </main>
</body>
@endsection