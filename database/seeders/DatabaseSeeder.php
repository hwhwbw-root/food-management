<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FoodListing;
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

        // Mock vendor accounts
        $vendors = [
            [
                'name'    => 'Nasi Lemak Wangi',
                'email'   => 'nasilemak@foodsaver.my',
                'phone'   => '0123001001',
                'address' => 'Jalan Tuanku Abdul Halim, Kuala Lumpur',
            ],
            [
                'name'    => 'Roti Canai Pak Man',
                'email'   => 'roticanai@foodsaver.my',
                'phone'   => '0123002002',
                'address' => 'Pasar Pagi Wangsa Maju, Kuala Lumpur',
            ],
            [
                'name'    => 'Kedai Kek Mira',
                'email'   => 'kedaikek@foodsaver.my',
                'phone'   => '0123003003',
                'address' => 'SS15, Subang Jaya, Selangor',
            ],
            [
                'name'    => 'Katering Ibu Zainab',
                'email'   => 'kateringibu@foodsaver.my',
                'phone'   => '0123004004',
                'address' => 'Bandar Baru Bangi, Selangor',
            ],
            [
                'name'    => 'Hotel Seri Melayu F&B',
                'email'   => 'hotelserifnb@foodsaver.my',
                'phone'   => '0123005005',
                'address' => 'Jalan Conlay, Kuala Lumpur',
            ],
        ];

        foreach ($vendors as $v) {
            User::firstOrCreate(
                ['email' => $v['email']],
                [
                    'name'     => $v['name'],
                    'password' => Hash::make('password'),
                    'role'     => 'vendor',
                    'phone'    => $v['phone'],
                    'address'  => $v['address'],
                ]
            );
        }

        // Mock food listings per vendor
        $listings = [
            // Nasi Lemak Wangi
            [
                'vendor_email'    => 'nasilemak@foodsaver.my',
                'category'        => 'Rice & Noodles',
                'title'           => 'Nasi Lemak Bungkus (10 packs)',
                'description'     => 'Freshly cooked nasi lemak with sambal, ikan bilis, and egg. Made this morning, best before evening.',
                'quantity'        => 10,
                'price'           => 1.50,
                'pickup_location' => 'Jalan Tuanku Abdul Halim, KL',
                'expiry_time'     => now()->addDays(3),
                'status'          => 'available',
            ],
            [
                'vendor_email'    => 'nasilemak@foodsaver.my',
                'category'        => 'Rice & Noodles',
                'title'           => 'Mee Goreng Mamak (5 portions)',
                'description'     => 'Leftover mee goreng from lunch service. Still hot and tasty.',
                'quantity'        => 5,
                'price'           => 0,
                'pickup_location' => 'Jalan Tuanku Abdul Halim, KL',
                'expiry_time'     => now()->addDays(3),
                'status'          => 'available',
            ],
            // Roti Canai Pak Man
            [
                'vendor_email'    => 'roticanai@foodsaver.my',
                'category'        => 'Bread & Pastry',
                'title'           => 'Roti Canai Plain (20 pieces)',
                'description'     => 'Freshly made roti canai. Comes with dhal curry. Pickup before 12pm.',
                'quantity'        => 20,
                'price'           => 0.50,
                'pickup_location' => 'Pasar Pagi Wangsa Maju, KL',
                'expiry_time'     => now()->addDays(3),
                'status'          => 'available',
            ],
            [
                'vendor_email'    => 'roticanai@foodsaver.my',
                'category'        => 'Bread & Pastry',
                'title'           => 'Tosai & Chutney (8 sets)',
                'description'     => 'Leftover tosai with coconut chutney and sambar. Great breakfast option.',
                'quantity'        => 8,
                'price'           => 1.00,
                'pickup_location' => 'Pasar Pagi Wangsa Maju, KL',
                'expiry_time'     => now()->addDays(3),
                'status'          => 'available',
            ],
            // Kedai Kek Mira
            [
                'vendor_email'    => 'kedaikek@foodsaver.my',
                'category'        => 'Desserts',
                'title'           => 'Kek Batik (1 loaf)',
                'description'     => 'Homemade kek batik, slightly imperfect cut. Perfect for sharing.',
                'quantity'        => 1,
                'price'           => 5.00,
                'pickup_location' => 'SS15, Subang Jaya, Selangor',
                'expiry_time'     => now()->addDays(3),
                'status'          => 'available',
            ],
            [
                'vendor_email'    => 'kedaikek@foodsaver.my',
                'category'        => 'Desserts',
                'title'           => 'Cupcakes Assorted (12 pcs)',
                'description'     => 'Mixed flavour cupcakes from yesterday — vanilla, chocolate, and red velvet. Still fresh.',
                'quantity'        => 12,
                'price'           => 3.00,
                'pickup_location' => 'SS15, Subang Jaya, Selangor',
                'expiry_time'     => now()->addDays(3),
                'status'          => 'available',
            ],
            // Katering Ibu Zainab
            [
                'vendor_email'    => 'kateringibu@foodsaver.my',
                'category'        => 'Meat & Poultry',
                'title'           => 'Ayam Masak Merah (15 portions)',
                'description'     => 'Leftover from a kenduri. Freshly cooked today. Comes with gravy.',
                'quantity'        => 15,
                'price'           => 0,
                'pickup_location' => 'Bandar Baru Bangi, Selangor',
                'expiry_time'     => now()->addDays(3),
                'status'          => 'available',
            ],
            [
                'vendor_email'    => 'kateringibu@foodsaver.my',
                'category'        => 'Vegetables',
                'title'           => 'Sayur Lodeh (10 portions)',
                'description'     => 'Mixed vegetable lodeh with tofu and tempeh. Great with rice.',
                'quantity'        => 10,
                'price'           => 0,
                'pickup_location' => 'Bandar Baru Bangi, Selangor',
                'expiry_time'     => now()->addDays(3),
                'status'          => 'available',
            ],
            // Hotel Seri Melayu F&B
            [
                'vendor_email'    => 'hotelserifnb@foodsaver.my',
                'category'        => 'Bread & Pastry',
                'title'           => 'Breakfast Bread Basket (30 pcs)',
                'description'     => 'Assorted bread rolls and croissants from the morning breakfast buffet. Best consumed today.',
                'quantity'        => 30,
                'price'           => 0,
                'pickup_location' => 'Jalan Conlay, Kuala Lumpur',
                'expiry_time'     => now()->addDays(3),
                'status'          => 'available',
            ],
            [
                'vendor_email'    => 'hotelserifnb@foodsaver.my',
                'category'        => 'Fruits',
                'title'           => 'Cut Fruit Platter (5 trays)',
                'description'     => 'Fresh cut fruits from buffet setup — watermelon, papaya, pineapple. Not yet displayed.',
                'quantity'        => 5,
                'price'           => 2.00,
                'pickup_location' => 'Jalan Conlay, Kuala Lumpur',
                'expiry_time'     => now()->addDays(3),
                'status'          => 'available',
            ],
        ];

        foreach ($listings as $l) {
            $vendor   = User::where('email', $l['vendor_email'])->first();
            $category = Category::where('name', $l['category'])->first();

            FoodListing::updateOrCreate(
                ['vendor_id' => $vendor->id, 'title' => $l['title']],
                [
                    'category_id'     => $category?->id,
                    'description'     => $l['description'],
                    'quantity'        => $l['quantity'],
                    'price'           => $l['price'],
                    'pickup_location' => $l['pickup_location'],
                    'expiry_time'     => $l['expiry_time'],
                    'status'          => $l['status'],
                ]
            );
        }
    }
}
