<?php

namespace App\Http\Middleware;

use App\Models\ManagementNotice;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NewNotice;

class NewNoticeForUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //このミドルウェアを利用するのは「新着のお知らせ：という表示をする必要のあるページ
        //ユーザーへの新着のお知らせを取得
        $user = Auth::user();
        $new_notices = NewNotice::query()
                        ->where('to_user',$user->id)
                        ->where('status', 0)
                        ->get();
        
        //新着お知らせの件数を取得
        $count_new_notices = $new_notices->count();

        //運営からのお知らせの出力
        $management_notices = ManagementNotice::all();
        // dd($management_notices);

        //リクエスト内に新着お知らせとその件数と運営からのお知らせを変数に入れる
        $request->merge(['new_notices' => $new_notices,
                         'count_new_notices' => $count_new_notices,
                         'management_notices' => $management_notices,
                        ]);

                        //  dd($request->management_notices);

        

        return $next($request);
    }
}
