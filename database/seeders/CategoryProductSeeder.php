<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = array(
            array('category_id' => 1, 'product_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 1, 'product_id' => 2, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 2, 'product_id' => 3, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 2, 'product_id' => 4, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 2, 'product_id' => 5, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 2, 'product_id' => 6, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 3, 'product_id' => 7, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 3, 'product_id' => 8, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 5, 'product_id' => 2, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 5, 'product_id' => 5, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 6, 'product_id' => 2, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 6, 'product_id' => 3, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 6, 'product_id' => 4, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 7, 'product_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 7, 'product_id' => 3, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 7, 'product_id' => 4, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 7, 'product_id' => 6, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 8, 'product_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 8, 'product_id' => 3, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 8, 'product_id' => 4, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 8, 'product_id' => 6, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 9, 'product_id' => 7, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 9, 'product_id' => 8, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 9, 'product_id' => 9, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 10, 'product_id' => 10, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 10, 'product_id' => 11, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 10, 'product_id' => 12, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 10, 'product_id' => 13, 'created_at' => now(), 'updated_at' => now()),
            array('category_id' => 10, 'product_id' => 14, 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('category_products')->insert($model);
    }
}
