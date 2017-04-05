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
        $i=1;
        while($i<=15)
        {
            DB::table('categories')->insert([
                'name' => 'cat'.$i,
                'parent_id' => null,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $i++;
        }
        

        $j=1;
        while($j<=50)
        {
            DB::table('categories')->insert([
                'name' => 'cat'.$j,
                'parent_id' => rand(1,15),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $j++;
        }
    }
}
