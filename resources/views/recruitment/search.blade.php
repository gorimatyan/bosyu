@extends('layouts.app')
@section('content')
<body>
    <main class="main-contents">
        <ul class="search">
            @foreach ($recruitments as $recruitment)
            <li class="search__recruitment">
                <div class="search__recruitment__title">
                    {{ $recruitment -> title }}
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
    
</body>
@endsection