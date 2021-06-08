<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Localization;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // brands Array
        $brands = [
            [
                'position' => '13',
                'status' => true,
                'slug' => 'Beko',
                'description' => 'beko description'
            ],
            [
                'position' => '13',
                'status' => true,
                'slug' => 'Toshiba',
                'description' => 'Toshiba description'
            ],
            [
                'position' => '13',
                'status' => true,
                'slug' => 'Samsung',
                'description' => 'Samsung description'
            ],
            [
                'position' => '13',
                'status' => true,
                'slug' => 'Philips',
                'description' => 'Philips description'
            ],
            [
                'position' => '13',
                'status' => true,
                'slug' => 'Evii',
                'description' => 'Evii description'
            ],
        ];

        $localizationID = Localization::getIdByName('en');

        foreach ($brands as $brand) {
            $model = new Brand([
                'position' => $brand['position'],
                'status' => $brand['status'],
                'slug' => $brand['slug']
            ]);
            $model->save();
            $model->language()->create([
                'brand_id' => $model->id,
                'language_id' => $localizationID,
                'title' => $brand['slug'],
                'description' => $brand['description'],
            ]);
        }
    }
}
