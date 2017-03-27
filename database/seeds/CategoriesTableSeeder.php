<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('categories')->insert([
                'name'=> 'cat'.rand(22,40),
                'parent_id'=>1,
                'created_at'=>\Carbon\Carbon::now()

            ]);
        DB::table('categories')->insert([
            'name'=> 'cat'.rand(2,9),
            'parent_id'=>null,
            'created_at'=>\Carbon\Carbon::now()
        ]);
    }
}
