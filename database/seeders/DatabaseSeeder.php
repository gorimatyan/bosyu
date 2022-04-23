<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('admins')->insert([
            'id' => 'hogehoge',
            'name' => 'gorimasan',
            'email' => 'test@test.com',
            'password' => Hash::make('hogehoge'),
        ]);

        DB::table('users')->insert([
            'id' => 1,
            'user_name' => 'hogehoge',
            'nickname' => 'gorimasan',
            'email' => 'test@test.com',
            'email_status' => 0,
            'password' => Hash::make('hogehoge'),
            'self_introduction' => 'こんにちゃーすごりまでぇーす',
            'image' => 'defaultUserImg.jpg',
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'user_name' => 'gorimatyan',
            'nickname' => 'ごりまちゃん',
            'email' => 'test@test.co.jp',
            'email_status' => 0,
            'password' => Hash::make('hogehoge'),
            'self_introduction' => 'idがgorimatyanです',
            'image' => 'defaultUserImg.jpg',
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'user_name' => 'testtest',
            'nickname' => 'テストテスト',
            'email' => 'test@test.ne.jp',
            'email_status' => 0,
            'password' => Hash::make('hogehoge'),
            'self_introduction' => 'idがtesttestです',
            'image' => 'defaultUserImg.jpg',
        ]);

        DB::table('recruitments')->insert(
        [
            // 'id' => uniqid(),
            'id' => '1',
            'user_id' => 1,
            'title' => 'ゲームしよう',
            'body' => 'Among usしましょう',
            'status' => 0,
            'number_of_people' => 10,
            'deadline' => '2022-10-21',
            'delete_flag' => 0,
        ]);

        DB::table('recruitments')->insert(
        [   
            'id' => '2',
            'user_id' => 2,
            'title' => 'ZOOMで会議！',
            'body' => 'いっぱい案出してください。',
            'status' => 0,
            'number_of_people' => 5,
            'deadline' => '2022-10-22',
            'delete_flag' => 0,
        ]);

        DB::table('recruitments')->insert(
        [
            'id' => '3',
            'user_id' => 2,
            'title' => 'idがgorimatyanの投稿だよ',
            'body' => 'ごりまです',
            'status' => 0,
            'number_of_people' => 5,
            'deadline' => '2022-10-22',
            'delete_flag' => 0,
        ]);

        DB::table('tags')->insert(
        [
            'id' => 1,
            'tag' => 'ゲーム',
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);

        DB::table('tags')->insert(
        [
            'id' => 2,
            'tag' => 'Laravel',
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);

        DB::table('tags')->insert(
        [
            'id' => 3,
            'tag' => 'Zoom',
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);
        
        DB::table('recruitment_tags')->insert(
        [
            'id' => 1,
            'tag_id' => 1,
            'recruitment_id' => '1',
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);
        DB::table('recruitment_tags')->insert(
        [
            'id' => 2,
            'tag_id' => 2,
            'recruitment_id' => '2',
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);
        DB::table('recruitment_tags')->insert(
        [
            'id' => 3,
            'tag_id' => 3,
            'recruitment_id' => '3',
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);

        DB::table('waiting_people')->insert(
            [
                'id' => uniqid(),
                'user_id' => 2,
                'title' => '今宿で鬼ごっこしましょう',
                'body' => '市営住宅で暴れまくりましょう。
                            柴田歯科前に集合しましょう。
                            あああああああああああああああああああああああ',
                'status' => 0,
                'created_at' =>now(),
                'updated_at' =>now(),
            ]);
        
        DB::table('waiting_people')->insert(
            [
                'id' => uniqid(),
                'user_id' => 1,
                'title' => '誰か勉強しましょう',
                'body' => '司法試験のお勉強しようぜー',
                'status' => 0,
                'created_at' =>now(),
                'updated_at' =>now(),
            ]);

        DB::table('waiting_people')->insert(
            [
                'id' => uniqid(),
                'user_id' => 2,
                'title' => 'NBA観に行きましょう',
                'body' => 'ハチ公前で一旦集合お願いシャス。とりあえずウォリアーズファン集まれ。',
                'status' => 0,
                'created_at' =>now(),
                'updated_at' =>now(),
            ]);
        
        DB::table('management_notices')->insert(
            [
                'id' => 1,
                'title' =>'当ウェブサイトが公開されました',
                'body' => 'やったねついに公開だ。ユーザー10億人目指すぞ～～～～～～',
                'created_at' =>now(),
                'updated_at' =>now(),
            ]);

        DB::table('favorite_tags')->insert(
            [
                'id' => 1,
                'user_id' => 1,
                'tag_id' => 2,
                'created_at' =>now(),
                'updated_at' =>now(),
            ]);
    
        DB::table('favorite_tags')->insert(
            [
                'id' => 2,
                'user_id' => 2,
                'tag_id' => 2,
                'created_at' =>now(),
                'updated_at' =>now(),
            ]);
    }
}
