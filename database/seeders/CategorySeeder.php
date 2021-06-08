<?php
/**
 *  database/seeders/LocalizationSeeder.php
 *
 * User:
 * Date-Time: 07.12.20
 * Time: 11:53
 * @author Giorgi Bakhbaia <gbaxbaia@gmail.com>
 */

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryLanguage;
use App\Models\Localization;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            [
                'position' => '1',
                'status' => true,
                'slug' => 'climatic-equipment',
            ],
            [
                'position' => '2',
                'status' => true,
                'slug' => 'small-home-appliances',
            ],
            [
                'position' => '3',
                'status' => true,
                'slug' => 'TVs-entertainment-facilities',
            ],
            [
                'position' => '4',
                'status' => true,
                'slug' => 'large-household-appliances',
            ],
            [
                'position' => '5',
                'status' => true,
                'slug' => 'computer-technology',
            ],
            [
                'position' => '6',
                'status' => true,
                'slug' => 'phones-accessories',
            ],

        ];


        $categoryLanguages = [
            [
                'language_id' => 1,
                'title' => 'კლიმატური ტექნიკა',
                'parent_id' => null,
            ],

            [
                'language_id' => 1,
                'title' => 'წვრილი საყოფაცხოვრებო ტექნიკა',
                'parent_id' => null,
            ],

            [
                'language_id' => 1,
                'title' => 'ტელევიზორები და გასართობი საშუალებები',
                'parent_id' => null,
            ],

            [
                'language_id' => 1,
                'title' => 'მსხვილი საყოფაცხოვრებო ტექნიკა',
                'parent_id' => null,
            ],

            [
                'language_id' => 1,
                'title' => 'კომპიუტერული ტექნიკა',
                'parent_id' => null,
            ],

            [
                'language_id' => 1,
                'title' => 'ტელეფონები და აქსესუარები',
                'parent_id' => null,
            ],
            [
                'language_id' => 2,
                'title' => 'Climatic equipment',
                'parent_id' => null,
            ],
            [
                'language_id' => 2,
                'title' => 'Small home appliances',
                'parent_id' => null,
            ],

            [
                'language_id' => 2,
                'title' => 'TVs and entertainment facilities',
                'parent_id' => null,
            ],
            [
                'language_id' => 2,
                'title' => 'Large household appliances',
                'parent_id' => null,
            ],
            [
                'language_id' => 2,
                'title' => 'Computer technology',
                'parent_id' => null,
            ],
            [
                'language_id' => 2,
                'title' => 'Phones and accessories',
                'parent_id' => null,
            ],
        ];

        $array = [];
        $i = 0;
        foreach ($categories as $category) {
            $model = new Category([
                'position' => $category['position'],
                'status' => $category['status'],
                'slug' => $category['slug']
            ]);
            $model->save();
            $array[] = $model->id;
        }

        foreach ($categoryLanguages as $category) {
            $model = new CategoryLanguage([
                'category_id' => $array[$i],
                'language_id' => $category['language_id'],
                'title' => $category['title'],
            ]);
            $model->save();
            if ($i == 5) {
                $i = 0;
                continue;
            }
            $i++;
        }
    }
}
