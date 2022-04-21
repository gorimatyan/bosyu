@extends('layouts.no_lists')
@section('content')
<div class="recruitment-details">
    <main class="recruitment-details__main">
    <form action="{{ route('recruitment.store') }}" method="POST">
                @csrf
        <div class="frame">

                <header class="recruitment-details__header">
                    <div class="recruitment-details__user-profile">
                        <img src="http://localhost:8000/storage/{{ $user->image }}" class="img-icon-size-small">
                        <div class="recruitment-details__user-profile__id">
                                <p class="">＠{{ $user->id }}</p>
                                <p class="">{{ $user->name }}</p>
                        </div>
                    </div>

                    

                    <p class="recruitment-details__recruitment-title">{{ $confirm_items['title'] }}</p>
                        <input type="hidden" value="{{ $confirm_items['title'] }}" name="title">
                        <div class="recruitment-details__tags">
                            <img src="http://localhost:8000/storage/Tag.png" alt="タグアイコン" class="tag-icon-small">
                            <p class="fontsize-14px bold">{{ $confirm_items['tag'] }}</p>
                                <input type="hidden" value="{{ $confirm_items['tag'] }}" name="tag">
                        </div>
                </header>

                <section class="recruitment-details__details">
                    <div class="recruitment-details__body">
                        <div class="recruitment-details__body__title bold">概要</div>
                        <div class="recruitment-details__text">{{ $confirm_items['body'] }}</div>
                            <input type="hidden" value="{{ $confirm_items['body'] }}" name="body">
                    </div>
                    <div class="recruitment-details__requirements">
                        <div class="recruitment-details__requirements__title bold">募集要件</div>
                        <div class="recruitment-details__text">{{ $confirm_items['requirement'] }}</div>
                            <input type="hidden" value="{{ $confirm_items['requirement'] }}" name="requirement">

                            <input type="hidden" value="{{ $confirm_items['deadline'] }}" name="deadline">
                            <input type="hidden" value="{{ $confirm_items['number_of_people'] }}" name="number_of_people">
                    </div>
                </section>
        

        </div>
        <input type="submit" class="submit-button__orange bold" value="送信">
        <a href="{{ route('recruitment.create',['items' => $confirm_items ]) }}" class="submit-button__orange bold">内容を修正する</a>
        </form>
    </main>
</div>
@endsection