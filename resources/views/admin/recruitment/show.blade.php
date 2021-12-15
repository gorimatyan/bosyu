@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-end">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.home')}}"><button type="button" class="list-group-item list-group-item-action">ホーム</button></a>
                <a href="{{ route('admin.index')}}"><button type="button" class="list-group-item list-group-item-action active">ユーザ編集</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Vestibulum at eros</button></a>
            </div>
        </div>



        <div class="col-md-9">
            <div class="card mb-4">
            </div>
        </div>
    </div>
</div>
@endsection