<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Pages array
        $pages = [
            [
                'slug' => 'home',
                'status' => true
            ],
            [
                'slug' => 'products',
                'status' => true
            ],
            [
                'slug' => 'about-us',
                'status' => true
            ],
            [
                'slug' => 'contact-us',
                'status' => true
            ],
            [
                'slug' => 'cart',
                'status' => true
            ],
            [
                'slug' => 'warranty',
                'status' => true
            ],
            [
                'slug' => 'privacy-policy',
                'status' => true
            ],
            [
                'slug' => 'payment-info',
                'status' => true
            ],
            [
                'slug' => 'delivery-info',
                'status' => true
            ],
        ];

        // Settings Array
        $settings = [
            [
                'key' => 'phone',
            ],
            [
                'key' => 'contact_email',
            ],
            [
                'key' => 'address',
            ],
            [
                'key' => 'facebook',
            ],
            [
                'key' => 'twitter',
            ],
            [
                'key' => 'behance',
            ],
            [
                'key' => 'linkedin',
            ],
            [
                'key' => 'instagram',
            ],
        ];

        // Insert pages
        Page::insert($pages);

        // Insert settings
        Setting::insert($settings);

        $this->call(CategorySeeder::class);
    }
}
