@extends('layouts.no_lists')
@section('content')
<body>
    <div class="container">
        <div class="recruitment-create__container__frame">
            <main>
                <div class="fontsize-32px bold">募集作成</div>
                <div class="recruitment-create__border-line"></div>
                <form action="{{ route('recruitment.store') }}" method="POST">
                    @csrf
                    <div class="recruitment-create__input">
                        <p>募集名（100字以内）</p>
                        <input class="grayframe width-max" type="text" name="title">
                    </div>
                    <div class="recruitment-create__input">
                        <p>本文（2000字以内）</p>
                        <textarea class="grayframe width-max" type="text" name="body"></textarea>
                    </div>
                    <div class="recruitment-create__input">
                        <p>条件（400字以内）</p>
                        <textarea class="grayframe width-max" name="requirement"></textarea>
                    </div>
                    <div class="recruitment-create__input">
                        <p>人数</p>
                        <input class="grayframe-small" type="text" name="number_of_people">
                    </div>
                    <div class="recruitment-create__input">
                        <p>募集〆切日</p>
                        <input class="grayframe width-half" type="date" name="deadline">
                    </div>
                    <div class="recruitment-create__input">
                        <p>タグ</p>
                        <input class="grayframe width-max" type="text" name="tag">
                    </div>
                    <div class="recruitment-create__border-line"></div>
                    <input type="submit" class="submit-button__orange bold" value="確認">
                    
                </form>
                
            </main>
        </div>
    </div>
</body>
@endsection