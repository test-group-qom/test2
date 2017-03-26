<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'post_id'=>1,
            'parent_id'=>null,
            'text'=>str_random(30),
            'from'=>'user'.rand(1,200),
            'email'=>'email'.rand(1,200).'@gmail.com',
            'created_at' =>\Carbon\Carbon::now()
        ]);
        DB::table('comments')->insert([
            'post_id'=>1,
            'parent_id'=>1,
            'text'=>str_random(30),
            'from'=>'user'.rand(1,200),
            'email'=>'email'.rand(1,200).'@gmail.com',
            'created_at' =>\Carbon\Carbon::now()
        ]);
    }
}
