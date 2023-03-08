<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            [
                'id' => 1, 'section_id' => 2, 'category_id' => 18, 'brand_id' => 10, 'vendor_id' => 2,
                'admin_type' => 'vendor', 'product_name' => 'Apple Iphone 12', 'product_code' => 'AI112',
                'product_color' => 'Grey', 'product_price' => '1500', 'product_discount' => 10,
                'product_weight' => 500, 'product_image' => '', 'product_video' => '', 'description' => '', 'meta_title' => '',
                'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'Yes', 'status' => 1
            ],
            [
                'id' => 2, 'section_id' => 2, 'category_id' => 18, 'brand_id' => 11, 'vendor_id' => 2,
                'admin_type' => 'vendor', 'product_name' => 'Sony Ericson Xperia Active', 'product_code' => 'SE222',
                'product_color' => 'Orange Silver', 'product_price' => '500', 'product_discount' => 10,
                'product_weight' => 500, 'product_image' => '', 'product_video' => '', 'description' => '', 'meta_title' => '',
                'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'Yes', 'status' => 1
            ],
            [
                'id' => 3, 'section_id' => 2, 'category_id' => 18, 'brand_id' => 6, 'vendor_id' => 2,
                'admin_type' => 'vendor', 'product_name' => 'Lenovo K14 Plus', 'product_code' => 'LK1000',
                'product_color' => 'Black', 'product_price' => '900', 'product_discount' => 10,
                'product_weight' => 500, 'product_image' => '', 'product_video' => '', 'description' => '', 'meta_title' => '',
                'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'Yes', 'status' => 1
            ],
        ];

        Products::insert($productRecords);
    }
}
