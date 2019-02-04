<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Rastler',
            'email'=>'rastler89@gmail.com',
            'rol'=>2,
            'password'=>app('hash')->make('patata'),
        ]);
    }
}
