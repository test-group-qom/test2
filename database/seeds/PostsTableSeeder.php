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
            'person_id'=>1,
            'created_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('posts')->insert([
            'title'=>'t'.rand(1,100),
            'text'=>str_random(50),
            'person_id'=>1,
            'created_at'=>\Carbon\Carbon::now()
        ]);
    }
}
