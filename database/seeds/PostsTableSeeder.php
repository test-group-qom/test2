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
        $i=1;
        while ($i<=100)
        {
            DB::table('posts')->insert([
                'title'=>'title'.$i,
                'text'=>str_random(50),
                'user_id'=>(rand(1,100)),
                'created_at'=> date('Y-m-d H:i:s')
            ]);
            $i++;
        }
    }
}
