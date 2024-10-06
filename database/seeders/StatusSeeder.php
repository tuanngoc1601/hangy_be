<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = array(
            array('name' => 'Chờ xác nhận', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Đã xác nhận', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Chờ vận chuyển', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Đang vận chuyển', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Hoàn thành', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Huỷ đơn hàng', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Trả hàng hoàn tiền', 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('statuses')->insert($models);
    }
}
