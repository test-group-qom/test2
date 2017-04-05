<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
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
            DB::table('files')->insert([
                'name'=> 'file'.$i,
                'extention'=>'jpg',
                'path'=> 'upload\file'.$i.'.jpg',
                'created_at'=> date('Y-m-d H:i:s')
            ]);  
            $i++;
        }
        
    }
}
