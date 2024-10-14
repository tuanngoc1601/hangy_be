<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlashSaleProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = array(
            array('flash_sale_id' => 1, 'product_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('flash_sale_id' => 1, 'product_id' => 2, 'created_at' => now(), 'updated_at' => now()),
            array('flash_sale_id' => 1, 'product_id' => 3, 'created_at' => now(), 'updated_at' => now()),
            array('flash_sale_id' => 1, 'product_id' => 4, 'created_at' => now(), 'updated_at' => now()),
            array('flash_sale_id' => 1, 'product_id' => 5, 'created_at' => now(), 'updated_at' => now()),
            array('flash_sale_id' => 1, 'product_id' => 6, 'created_at' => now(), 'updated_at' => now()),
            array('flash_sale_id' => 1, 'product_id' => 7, 'created_at' => now(), 'updated_at' => now()),
            array('flash_sale_id' => 1, 'product_id' => 8, 'created_at' => now(), 'updated_at' => now()),
            array('flash_sale_id' => 1, 'product_id' => 9, 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('flash_sale_products')->insert($models);
    }
}
