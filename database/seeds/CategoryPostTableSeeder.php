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
        $i=1;
        while($i<=100)
        {
            DB::table('category_post')->insert([
                'category_id' => rand(1,50),
                'post_id' => rand(1,100)
            ]);
            $i++;
        }
    }
}
