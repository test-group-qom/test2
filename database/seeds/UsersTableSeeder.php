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
        $i=1;
        while($i<=100)
        {
        DB::table('users')->insert([
            'name'=>'user'.$i,
            'email'=>'mail'.$i.'@gmail.com',
            'password'=>Hash::make(str_random(6)),
            'token'=>str_random(60),
            //'remember_token'=>'ggg',
            'created_at'=> date('Y-m-d H:i:s')
        ]);
            $i++;
        }
    }
}