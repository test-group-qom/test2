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
            'name'=>str_random(5),
            'email'=>str_random(5).'@gmail.com',
            'password'=>Hash::make('123'),
            'token'=>str_random(60),
            //'remember_token'=>'ggg',
            'created_at'=> date('Y-m-d H:i:s')
        ]);
    }
}
