<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title'=>'t'.rand(1,100),
            'text'=>str_random(50),
            'user_id'=>1,
            'file_id'=>1,
            'created_at'=> date('Y-m-d H:i:s')
        ]);
        DB::table('posts')->insert([
            'title'=>'t'.rand(1,100),
            'text'=>str_random(50),
            'user_id'=>1,
            'file_id'=>1,
            'created_at'=> date('Y-m-d H:i:s')
        ]);
    }
}
