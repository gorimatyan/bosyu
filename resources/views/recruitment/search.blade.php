@extends('layouts.app')
@section('content')
<body>
    <div class="container">
        <main class="main-contents">
            <ul class="search">
                @foreach ($recruitments as $recruitment)
                <li class="search__recruitment">
                    <div class="search__recruitment__title">
                        <a href="{{ route('recruitment.show',['recruitment_id'=>$recruitment -> id]) }}" >{{ $recruitment -> title }}</a>
                    </div>
                    <div class="search__recruitment__body">
                        {{ $recruitment -> body }}
                    </div>
                </li>
                @endforeach
            </ul>
        </main>

        <div class='side-bar'>
        </div>
    </div>
</body>
@endsection