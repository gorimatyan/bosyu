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
                        <li class="breadcrumb-item"><a href="#">編集</a></li>
                        <li class="breadcrumb-item"><a href="#">削除</a></li>
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

                    <form action="/admin/{{ $user->id }}" method="post">
                        <table class="table table-responsive">

                            <input type="hidden" name="_method" value="PUT">
                            {!! csrf_field() !!}
                            <tr>
                                <td>ID</td>
                                <td><input type="text" name="id" value="{{ $user->id }}"></td>
                            </tr>
                            <tr>
                                <td>名前</td>
                                <td><input type="text" name="name" value="{{ $user->name }}"></td>
                            </tr>
                            <tr>
                                <td>メールアドレス</td>
                                <td><input type="text" name="email" value="{{ $user->email }}"></td>
                            </tr>
                            <tr>
                                <td>ステータス</td>
                                <td><input type="text" name="delete_flag" value="{{ $user->delete_flag }}"></td>
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
                                <td><input type="text" name="user_description" value="{{ $user->user_description }}"></td>
                            </tr>
                            <tr>
                                <td>募集中のBOSYU</td>
                                <td><input type="text" name="bosyu" value="{{ $user->bosyu }}"></td>
                            </tr>
                            <tr>
                                <td>参加したBOSYU</td>
                                <td><input type="text" name="entry" value="{{ $user->entry }}"></td>
                            </tr>
                            <tr>
                                <td>性別</td>
                                <td><input type="text" name="gender" value="{{ $user->gender }}"></td>
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
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
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


                </div>
            </div>
        </div>
    </div>
</div>
@endsection