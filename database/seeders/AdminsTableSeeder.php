<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        $adminRecords = [
            [
                'id' => 2,
                'name' => 'John',
                'type' => 'vendor',
                'vendor_id' => 1,
                'mobile' => '082240312829',
                'email' => 'john@admin.com',
                'password' => '$2a$12$VWwc8bk0V1gxD.YUZfRnVemtjGbV3ziVJMBYQrfuFLW5c7.IC/dHO',
                'image' => '',
                'status' => 1
            ]
        ];
        Admin::insert($adminRecords);
    }
}
