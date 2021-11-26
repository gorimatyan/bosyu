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
    }
}
