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
            'password'=>bcrypt('123'),
            'remember_token'=>str_random(60),
            'created_at'=>\Carbon\Carbon::now()
        ]);
    }
}
