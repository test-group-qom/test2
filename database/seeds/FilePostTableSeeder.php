<?php

use Illuminate\Database\Seeder;

class FilePostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i=1;
        while($i<=50)
        {
            DB::table('file_post')->insert([
                'file_id'=>rand(1,100),
                'post_id'=>rand(1,100)
            ]);
            
            $i++;  
        }
    }
}
