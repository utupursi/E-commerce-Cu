<?php
/**
 *  database/seeders/LocalizationSeeder.php
 *
 * User:
 * Date-Time: 07.12.20
 * Time: 11:53
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace Database\Seeders;

use App\Models\Localization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Localization Array
        $localizations = [
            [
                'title' => 'GEO',
                'abbreviation' => 'ge',
                'native' => 'ქართული',
                'locale' => 'ka_GE',
                'status' => true,
                'default' => true
            ],
            [
                'title' => 'ENG',
                'abbreviation' => 'en',
                'native' => 'English',
                'locale' => 'en_US',
                'status' => true,
                'default' => false
            ],
            [
                'title' => 'RUS',
                'abbreviation' => 'ru',
                'native' => 'Русский',
                'locale' => 'ru_RU',
                'status' => true,
                'default' => false
            ]
        ];


        // Insert localizations
        Localization::insert($localizations);
    }
}
