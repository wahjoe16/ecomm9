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
                'id' => 1,
                'name' => 'Super Admin',
                'type' => 'superadmin',
                'vendor_id' => 0,
                'mobile' => '082240312828',
                'email' => 'test@admin.com',
                'password' => '$2a$12$QQ/N9IIL33uaZbgnM0C98emjxF/Yomz7zZW6c.vOYLLi6z30nOQjO',
                'image' => '',
                'status' => 1
            ]
        ];
        Admin::insert($adminRecords);
    }
}
