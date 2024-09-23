<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = array(
            array('name' => 'HG23 Trắng Đen Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HG23 Đen Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HG23 Mix Nâng Cấp', 'real_price' => 1600000, 'daily_price' => 719000, 'flash_sale_price' => 700000, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HM23 Trắng Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 2, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HG23 Đen Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 2, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HG23 Xanh Mint Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 2, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'H1 Trắng Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 3, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'H1 Đen Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 3, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'H1 Hồng Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 3, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HY23 Pro Trắng Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 4, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HY23 Pro Đen Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 4, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HY23 Pro Hồng Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 4, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HY23 Pro Xanh Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 4, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HY23 Trẻ em Vàng Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 5, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HY23 Trẻ em Xanh Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 5, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HY23 Trẻ em Hồng Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 5, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HY23 Ultra Trắng Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 6, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'HY23 Ultra Đen Nâng Cấp', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 6, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Vị Đào', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 7, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Vị Bạc Hà', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 7, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Vị Chanh Bạc Hà', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 8, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Vị Bạc Hà', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 8, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Vị Chanh Bạc Hà', 'real_price' => null, 'daily_price' => null, 'flash_sale_price' => null, 'stock_quantity' => 100, 'sold_quantity' => 100, 'product_id' => 8, 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('sub_products')->insert($model);
    }
}
