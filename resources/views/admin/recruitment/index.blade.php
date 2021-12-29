@foreach($recruitments as $recruitment)

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

@endforeach