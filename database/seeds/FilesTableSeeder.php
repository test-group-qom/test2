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
        DB::table('files')->insert([
            'name'=> 'file1',
            'extention'=>'jpg',
            'path'=> 'upload\file1.jpg',
            'created_at'=> date('Y-m-d H:i:s')
        ]);
    }
}
