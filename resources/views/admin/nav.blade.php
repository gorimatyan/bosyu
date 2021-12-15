@section('nav')
<div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.home')}}"><button type="button" class="list-group-item list-group-item-action">ホーム</button></a>
                <a href="{{ route('admin.index')}}"><button type="button" class="list-group-item list-group-item-action active">ユーザ編集</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Vestibulum at eros</button></a>
            </div>
        </div>
@endsection