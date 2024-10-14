<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlashSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = array(
            array('name' => 'Test Flash sale', 'time_start' => '2024-10-13 00:00:00', 'time_end' => '2024-10-15 12:00:00', 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('flash_sales')->insert($models);
    }
}
