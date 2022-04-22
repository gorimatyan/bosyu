@extends('layouts.no_list')
@section('content')

<body>
    <div class="container">
        <div class="recruitment-create__container__frame">
            <main>
                <div class="fontsize-32px bold">募集の修正</div>
                <div class="recruitment-create__border-line"></div>
                <form action="{{ route('recruitment.update',['recruitment_id' => $recruitment -> id]) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="input-box">
                        <p>募集名（100字以内）</p>
                        <input class="grayframe width-max" type="text" name="title" value="{{ $recruitment -> title }}">
                    </div>
                    <div class="input-box">
                        <p>本文（2000字以内）</p>
                        <textarea class="grayframe width-max" type="text" name="body">{{ $recruitment -> body }}</textarea>
                    </div>
                    <div class="input-box">
                        <p>条件（400字以内）</p>
                        <textarea class="grayframe width-max" name="requirement">{{ $recruitment -> requirement }}</textarea>
                    </div>
                    <div class="input-box">
                        <p>人数</p>
                        <input class="grayframe-small" type="text" name="number_of_people" value="{{ $recruitment -> number_of_people }}">
                    </div>
                    <div class="input-box">
                        <p>募集〆切日</p>
                        <input class="grayframe width-half" type="date" name="deadline" value="{{ $recruitment -> deadline }}">
                    </div>
                    <div class="input-box">
                        <p>タグ</p>
                        <input class="grayframe width-max" type="text" name="tag" value="{{ implode(' ',$tags) }}">
                    </div>
                    <div class="recruitment-create__border-line"></div>
                    <input type="submit" class="submit-button__orange bold" value="更新">
                    
                </form>
                
            </main>
        </div>
    </div>
</body>

@endsection

<!-- <form action="{{ route('recruitment.update',['recruitment_id' => $recruitment -> id]) }}" method="POST">
            @csrf
            @method("PUT")
            <p>
            <label for="title">募集名</label>
            <input type="text" name="title" id="title" value="{{$recruitment -> title}}">
            </p>
            <p>
            <label for="number_of_people">人数</label>
            <input type="text" name="number_of_people" id="number_of_people" value=" ">
            </p>
            <p>
            <label for="body">説明</label>
            <input type="text" name="body" id="body" value="{{$recruitment -> body}}">
            </p>
            <p>
            <label for="deadline">募集〆切日</label>
            <input type="date" name="deadline" id="deadline" value="{{$recruitment -> deadline}}">
            </p>
            <p>
            <label for="tag">タグ</label>
            <input type="text" name="tag" id="tag">
            </p>
            <input type="submit" value="送信">
        </form> -->