<?php
use \Illuminate\Support\Facades;
use Illuminate\Database\Seeder;

class CategoryPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_post')->insert([
            'category_id'=>1,
            'post_id'=>2
        ]);
        DB::table('category_post')->insert([
            'category_id'=>2,
            'post_id'=>1
        ]);
    }
}
