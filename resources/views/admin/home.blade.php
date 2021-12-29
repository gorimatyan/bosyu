@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-end">
        <div class="col-md-2">
            <div class="list-group">
                <button type="button" class="list-group-item list-group-item-action active">
                    ホーム
                </button>
                <a href="{{ route('admin.index')}}"><button type="button" class="list-group-item list-group-item-action">ユーザーの編集</button></a>
                <a href="{{ route('admin.recruitment.index')}}"><button type="button" class="list-group-item list-group-item-action">募集の編集</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Vestibulum at eros</button></a>
            </div>
        </div>

        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">{{ __('管理者一覧') }}</div>

                <div class="card-body ">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-Mail</th>
                                <th scope="col">作成日</th>
                                <th scope="col">更新日</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                            <tr>
                                <th scope="row">{{ $admin->id }}</th>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->created_at }}</td>
                                <td>{{ $admin->updated_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            
        </div>
    </div>
</div>
@endsection