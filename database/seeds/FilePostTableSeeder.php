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
        DB::table('file_post')->insert([
            'file_id'=>1,
            'post_id'=>1
        ]);
    }
}
