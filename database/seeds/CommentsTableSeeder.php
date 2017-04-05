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
        $i=1;
        while($i<=40)
    {
        DB::table('comments')->insert([
            'post_id' => rand(1,100),
            'parent_id' => null,
            'text' => str_random(30),
            'from' => 'user'.rand(1, 100),
            'email' => 'email'.rand(1, 100).'@gmail.com',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $i++;
    }
        
        $j=1;
        while($j<=60)
        {
            DB::table('comments')->insert([
                'post_id' => rand(1,100),
                'parent_id' => rand(1,10),
                'text' => str_random(30),
                'from' => 'user'.rand(1, 100),
                'email' => 'email'.rand(1, 100).'@gmail.com',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        $j++;
        }
        
    }
}