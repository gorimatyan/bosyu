@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-end">
        <div class="col-md-2">
            <div class="list-group">
                <a href="{{ route('admin.home')}}"><button type="button" class="list-group-item list-group-item-action">ホーム</button></a>
                <a href="{{ route('admin.index')}}"><button type="button" class="list-group-item list-group-item-action">ユーザ編集</button></a>
                <a href="#"><button type="button" class="list-group-item list-group-item-action active">投稿の編集</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button></a>
                <a href='#'><button type="button" class="list-group-item list-group-item-action">Vestibulum at eros</button></a>
            </div>
        </div>



        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">
                    投稿の詳細 <br>
                    ユーザー名:{{ $user->name }} / ID:{{ $user->id }}
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 ml-2 bg-white">
                            <li class="breadcrumb-item  mr-2">
                                <a href="#">
                                    <button class="btn btn-primary">
                                        編集
                                    </button>
                                </a>
                            </li>
                        
                        
                        <form action="#" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {!! csrf_field() !!}
                            
                            <li class="breadcrumb-item">
                                <button type="submit" class="btn btn-danger">
                                    削除
                                </button>
                            </li>
                        </form>
                    </ol>
                </nav>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                       
                    <table class="table table-responsive">
                        <tr>
                            <td>タイトル</td>
                            <td>{{ $recruitment->title }}</td>
                        </tr>
                        <tr>
                            <td>募集作成日</td>
                            <td>{{ $recruitment->created_at }}</td>
                        </tr>
                        <tr>
                            <td>募集更新日</td>
                            <td>{{ $recruitment->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>ステータス</td>
                            <td>{{ $recruitment->delete_flag }}</td>
                        </tr>
                        <tr>
                            <td>説明文</td>
                            <td>{{ $recruitment->body }}</td>
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
                                <td><a href="{{ route('admin.edit' , ['id' => $user->id]) }}">{{ $user->id }}</a></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->delete_flag }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>

                            </tr>



                        </tbody>

                    </table> -->
                </div>

            </div>
        </div>
    </div>
</div>
@endsection