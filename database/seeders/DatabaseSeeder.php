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
            'id' => 'hogehoge',
            'name' => 'gorimasan',
            'email' => 'test@test.com',
            'password' => Hash::make('hogehoge'),
            'self_introduction' => 'こんにちゃーすごりまでぇーす',
            'image' => 'defaultUserImg.jpg',
        ]);

        DB::table('users')->insert([
            'id' => 'gorimatyan',
            'name' => 'ごりまちゃん',
            'email' => 'test@test.co.jp',
            'password' => Hash::make('hogehoge'),
            'self_introduction' => 'idがgorimatyanです',
            'image' => 'defaultUserImg.jpg',
        ]);

        DB::table('users')->insert([
            'id' => 'testtest',
            'name' => 'テストテスト',
            'email' => 'test@test.ne.jp',
            'password' => Hash::make('hogehoge'),
            'self_introduction' => 'idがtesttestです',
            'image' => 'defaultUserImg.jpg',
        ]);

        DB::table('recruitments')->insert(
        [
            'id' => uniqid(),
            'user_id' => 'hogehoge',
            'title' => 'ゲームしよう',
            'body' => 'Among usしましょう',
            'status' => 0,
            'number_of_people' => 10,
            'deadline' => '2022-10-21',
            'delete_flag' => 0,
        ]);

        DB::table('recruitments')->insert(
        [   
            'id' => uniqid(),
            'user_id' => 'hogehoge',
            'title' => 'ZOOMで会議！',
            'body' => 'いっぱい案出してください。',
            'status' => 0,
            'number_of_people' => 5,
            'deadline' => '2022-10-22',
            'delete_flag' => 0,
        ]);

        DB::table('recruitments')->insert(
        [
            'id' => uniqid(),
            'user_id' => 'gorimatyan',
            'title' => 'idがgorimatyanの投稿だよ',
            'body' => 'ごりまです',
            'status' => 0,
            'number_of_people' => 5,
            'deadline' => '2022-10-22',
            'delete_flag' => 0,
        ]);

        DB::table('comments')->insert(
        [
            
        ]);

        DB::table('tags')->insert(
        [
            'id' => 1,
            'tag' => 'Laravel',
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);

        DB::table('tags')->insert(
        [
            'id' => 2,
            'tag' => 'Zoom',
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);

        DB::table('waiting_people')->insert(
            [
                'id' => uniqid(),
                'user_id' => 'gorimatyan',
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
                'user_id' => 'hogehoge',
                'title' => '誰か勉強しましょう',
                'body' => '司法試験のお勉強しようぜー',
                'status' => 0,
                'created_at' =>now(),
                'updated_at' =>now(),
            ]);

        DB::table('waiting_people')->insert(
            [
                'id' => uniqid(),
                'user_id' => 'gorimatyan',
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
                'user_id' =>'hogehoge',
                'tag_id' => 2,
                'created_at' =>now(),
                'updated_at' =>now(),
            ]);
    
        DB::table('favorite_tags')->insert(
            [
                'id' => 2,
                'user_id' =>'gorimatyan',
                'tag_id' => 2,
                'created_at' =>now(),
                'updated_at' =>now(),
            ]);
    }
}
