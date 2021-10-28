@extends('layouts.app')
@section('content')
<body>
    <main>
        <form action="{{ route('recruitment.store') }}" method="POST">
            @csrf
            <p>
            <label for="recruitment_name">募集名</label>
            <input type="text" name="recruitment_name" id="recruitment_name">
            </p>
            <p>
            <label for="number_of_people">人数</label>
            <input type="text" name="number_of_people" id="number_of_people">
            </p>
            <p>
            <label for="discription">説明</label>
            <input type="text" name="discription" id="discription">
            </p>
            <p>
            <label for="tag">タグ</label>
            <input type="text" name="tag" id="tag">
            </p>
            <input type="submit" value="送信">
        </form>
        
    </main>
</body>
@endsection