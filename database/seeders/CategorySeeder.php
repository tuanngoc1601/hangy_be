<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = array(
            array('name' => 'Máy tăm nước', 'slug' => 'may-tam-nuoc', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Bàn chải điện', 'slug' => 'ban-chai-dien', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Sản phẩm súc miệng', 'slug' => 'san-pham-suc-mieng', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Combo', 'slug' => 'combo', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Dành cho trẻ em', 'slug' => 'danh-cho-tre-em', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Dành cho răng nướu yếu/người cao tuổi', 'slug' => 'danh-cho-rang-nuou-yeu-nguoi-cao-tuoi', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Dành cho răng nướu khỏe', 'slug' => 'danh-cho-rang-nuou-khoe', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Dành cho người niềng răng', 'slug' => 'danh-cho-nguoi-nieng-rang', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Kem đánh răng', 'slug' => 'kem-danh-rang', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Phụ kiện', 'slug' => 'phu-kien', 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('categories')->insert($model);
    }
}
