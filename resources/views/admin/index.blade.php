@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-end">
        <div class="col-md-2">
            <div class="list-group">
                <a href="{{ route('admin.home')}}"><button type="button" class="list-group-item list-group-item-action">ホーム</button></a>
                <a href="{{ route('admin.index')}}"><button type="button" class="list-group-item list-group-item-action active">ユーザーの編集</button></a>
                <a href="{{ route('admin.recruitment.index')}}"><button type="button" class="list-group-item list-group-item-action">募集の編集</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Vestibulum at eros</button></a>
            </div>
        </div>



        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">{{ __('ユーザー情報') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">アイコン</th>
                                <th scope="col">ID</th>
                                <th scope="col">名前</th>
                                <th scope="col">メールアドレス</th>
                                <th scope="col">ステータス</th>
                                <th scope="col">作成日</th>
                                <th scope="col">更新日</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row"><img src="http://localhost:8000/storage/{{ $user->image }}" class='db-icon-min-size img-icon'></th>
                                <td><a href="{{ route('admin.show' , ['id' => $user->id]) }}">{{ $user->id }}</a></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->delete_flag }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users ->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection