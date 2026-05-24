<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Default categories
        $categories = ['Rice & Noodles', 'Bread & Pastry', 'Vegetables', 'Fruits', 'Meat & Poultry', 'Beverages', 'Desserts', 'Others'];
        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }

        // Admin account
        User::firstOrCreate(
            ['email' => 'admin@foodsaver.my'],
            [
                'name'     => 'FoodSaver Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // Demo vendor
        User::firstOrCreate(
            ['email' => 'vendor@foodsaver.my'],
            [
                'name'     => 'Demo Vendor',
                'password' => Hash::make('password'),
                'role'     => 'vendor',
                'phone'    => '0123456789',
                'address'  => 'Kuala Lumpur, Malaysia',
            ]
        );

        // Demo buyer
        User::firstOrCreate(
            ['email' => 'buyer@foodsaver.my'],
            [
                'name'     => 'Demo Buyer',
                'password' => Hash::make('password'),
                'role'     => 'buyer',
                'phone'    => '0198765432',
                'address'  => 'Petaling Jaya, Malaysia',
            ]
        );
    }
}
