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
            'path'=> 'upload/'.'file1.jpg',
            'extention'=>'jpg',
            'person_id'=>'1',
            'created_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('files')->insert([
            'name'=> 'file2',
            'path'=> 'upload/'.'file2.jpg',
            'extention'=>'jpg',
            'person_id'=>'1',
            'created_at'=>\Carbon\Carbon::now()
        ]);
    }
}
