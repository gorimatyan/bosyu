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
            'number' => 1,
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
            'number' => 2,
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
            'number' => 3,
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
    }
}
