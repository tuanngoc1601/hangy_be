<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = array(
            array('name' => 'Máy tăm nước HANGY HG23 và HF-2 nâng cấp chống thấm nước [BẢO HÀNH ĐỔI MỚI 12 THÁNG - KÈM CỦ SẠC]', 'slug' => 'may-tam-nuoc-hangy-hg23-chong-tham-nuoc', 'real_price' => 1550000, 'daily_price' => 699000, 'flash_sale_price' => 680000, 'stock_quantity' => 150, 'sold_quantity' => 250, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Máy tăm nước gấp gọn HANGY HM23 và XY-6 Nâng Cấp Phiên bản mới nhất 2024 [1 đổi 1 trong 12 tháng]', 'slug' => 'may-tam-nuoc-gap-gon-hangy-hm23-phien-ban-moi-nhat', 'real_price' => 1550000, 'daily_price' => 739000, 'flash_sale_price' => 719000, 'stock_quantity' => 150, 'sold_quantity' => 250, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Bàn chải điện HANGY chuẩn nha khoa H1 Siêu sóng âm làm trắng răng [Bảo hành 2 năm]', 'slug' => 'ban-chai-dien-hangy-nha-khoa-h1-trang-rang', 'real_price' => 1500000, 'daily_price' => 689000, 'flash_sale_price' => 599000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Bàn chải điện HANGY chuẩn nha khoa HY21 & HY23 Pro Siêu sóng âm làm trắng răng [Bảo hành 2 năm]', 'slug' => 'ban-chai-dien-hangy-nha-khoa-hy21-hy23pro', 'real_price' => 1450000, 'daily_price' => 639000, 'flash_sale_price' => 599000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Bàn chải điện HANGY chuẩn nha khoa HY23 dành cho Trẻ em [Bảo hành 2 năm]', 'slug' => 'ban-chai-dien-hangy-nha-khoa-hy23-danh-cho-tre-em', 'real_price' => 999000, 'daily_price' => 549000, 'flash_sale_price' => 529000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Bàn chải điện HANGY chuẩn nha khoa HY23 Ultra [Bảo hành 2 năm]', 'slug' => 'ban-chai-dien-hangy-nha-khoa-hy23-ultra', 'real_price' => 1850000, 'daily_price' => 929000, 'flash_sale_price' => 879000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Nước súc miệng HANGY dạng gói 10ml giúp thơm miệng, dùng 1 lần tiện lợi và có thể mang ra ngoài', 'slug' => 'nuoc-suc-mieng-hangy-dang-goi-giup-thom-mieng', 'real_price' => 145000, 'daily_price' => 33000, 'flash_sale_price' => 25000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Tinh chất súc miệng Hangy chuyên dụng cho máy tăm nước diệt sạch 99% vi khuẩn, sát khuẩn mắc cài, khử mùi hôi miệng 15ml', 'slug' => 'tinh-chat-suc-mieng-hangy-chuyen-dung-cho-may-tam-nuoc', 'real_price' => 390000, 'daily_price' => 195000, 'flash_sale_price' => 179000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Kem đánh răng Phoca phân phối bởi Hangy', 'slug' => 'kem-danh-rang-phoca-phan-phoi-boi-hangy', 'real_price' => 110000, 'daily_price' => 60000, 'flash_sale_price' => 49000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Phụ kiện bàn chải điện Hangy chuẩn nha khoa HY23 Pro', 'slug' => 'phu-kien-ban-chai-dien-chuan-nha-khoa-hangy-h23pro', 'real_price' => 110000, 'daily_price' => 60000, 'flash_sale_price' => 50000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Phụ kiện bàn chải điện Hangy chuẩn nha khoa HY23 TE', 'slug' => 'phu-kien-ban-chai-dien-chuan-nha-khoa-hangy-h23te', 'real_price' => 110000, 'daily_price' => 60000, 'flash_sale_price' => 50000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Phụ kiện HF chuẩn nha khoa Hangy', 'slug' => 'phu-kien-nha-khoa-hf-chuan-hangy', 'real_price' => 110000, 'daily_price' => 60000, 'flash_sale_price' => 50000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Phụ kiện máy tăm nước Hangy chuẩn nha khoa HG23', 'slug' => 'phu-kien-may-tam-nuoc-chuan-nha-khoa-hangy-hg23', 'real_price' => 110000, 'daily_price' => 60000, 'flash_sale_price' => 50000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Phụ kiện máy tăm nước Hangy chuẩn nha khoa HM23', 'slug' => 'phu-kien-may-tam-nuoc-chuan-nha-khoa-hangy-hm23', 'real_price' => 110000, 'daily_price' => 60000, 'flash_sale_price' => 50000, 'stock_quantity' => 200, 'sold_quantity' => 350, 'created_at' => now(), 'updated_at' => now()),
        );

        DB::table('products')->insert($model);
    }
}
