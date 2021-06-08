<?php
/**
 *  app/Http/View/Composers/MenuComposer.php
 *
 * User:
 * Date-Time: 28.10.20
 * Time: 14:33
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\View\Composers;

use App\Models\Localization;
use Illuminate\View\View;

class LanguageComposer
{

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('languages', $this->languageItems());
    }

    public function languageItems()
    {
        $localizations = Localization::where('status', true)->get();

        $languages = [];
        $languages['data'] = [];
        if (count($localizations) > 0) {
            foreach ($localizations as $localization) {
                if ($localization->abbreviation == app()->getLocale()) {
                    $languages['abbreviations'][] = $localization->abbreviation;
                    $languages['current']= [
                        'title' => $localization->native,
                        'url' => '',
                        'img' => $localization->abbreviation . '.png',
                        'abbreviation' => $localization->abbreviation
                    ];
                    continue;
                }
                $languages['abbreviations'][] = $localization->abbreviation;
                $languages['data'][]= [
                    'title' => $localization->native,
                    'url' => $this->getUrl($localization->abbreviation),
                    'img' => $localization->abbreviation . '.png',
                    'abbreviation' => $localization->abbreviation
                ];
            }
        }
       return $languages;

    }

    protected function getUrl($lang) {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $replaceLang = '/'.app()->getLocale();
        $replaceBy = '/'.$lang;
        return str_replace($replaceLang,$replaceBy,$actual_link);
    }
}
