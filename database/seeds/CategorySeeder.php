<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                'name' => 'web development',
            ]
        );
        DB::table('categories')->insert(
            [
                'name' => 'mobile',
            ]
        );
        DB::table('categories')->insert(
            [
                'name' => 'machine learning',
            ]
        );
    }
}
