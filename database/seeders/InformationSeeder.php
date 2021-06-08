<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Settings Array
        $settings = [
            [
                'key' => 'pay_by_cash',
            ],
            [
                'key' => 'transfer',
            ],
            [
                'key' => 'payment_by_card',
            ],
            [
                'key' => 'bank_installment',
            ],
            [
                'key' => 'internal_installment',
            ],
            [
                'key' => 'requisite_1',
            ],
            [
                'key' => 'requisite_2',
            ],
        ];


        // Insert settings
        Setting::insert($settings);
    }
}
