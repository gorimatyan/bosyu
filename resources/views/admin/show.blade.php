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
                <div class="card-header">ユーザ詳細</div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 ml-2 bg-white">
                            <li class="breadcrumb-item  mr-2"><a href="/admin/{{ $user->id }}/edit">
                            <button class="btn btn-primary">編集</button>
                        </a>
                    </li>
                            <form action="/admin/{{ $user->id }}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {!! csrf_field() !!}
                                <li class="breadcrumb-item"><button type="submit" class="btn btn-danger">削除</button></li>
                            </form>
                        </ol>
                    </nav>

                    <!-- <ul class="row" >
                        <li>{{ __('ユーザー詳細') }}</li>
                        <li><a href="{{ route('admin.index')}}" class="border-left mx-3 px-2">一覧に戻る</a></li>
                    </ul> -->
                

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-responsive">
                        <tr>
                            <td>ID</td>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td>名前</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>メールアドレス</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>ステータス</td>
                            <td>{{ $user->delete_flag }}</td>
                        </tr>
                        <tr>
                            <td>アカウント作成日</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <td>アカウント更新日</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>自己紹介</td>
                            <td>{{ $user->user_description }}</td>
                        </tr>
                        <tr>
                            <td>募集中のBOSYU</td>
                            <td>{{ $user->bosyu }}</td>
                        </tr>
                        <tr>
                            <td>参加したBOSYU</td>
                            <td>{{ $user->entry }}</td>
                        </tr>
                        <tr>
                            <td>性別</td>
                            <td>{{ $user->gender }}</td>
                        </tr>

                        <tr>
                            <td>11-1</td>
                            <td>11-2</td>
                        </tr>
                        <tr>
                            <td>12-1</td>
                            <td>12-2</td>
                        </tr>
                    </table>

                    <!-- <thead>
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

                            <tr>
                                <th scope="row"><img src="http://localhost:8000/storage/{{ $user->image }}" class='db-icon-min-size img-icon'></th>
                                <td><a href="/{{ $user->id }}">{{ $user->id }}</a></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->delete_flag }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>

                            </tr>



                        </tbody> -->

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection