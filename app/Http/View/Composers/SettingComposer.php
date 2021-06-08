<?php
/**
 *  app/Http/View/Composers/SettingComposer.php
 *
 * User:
 * Date-Time: 13.01.21
 * Time: 16:57
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\Localization;
use App\Models\Setting;
use App\Services\CategoryService;
use Illuminate\View\View;

class SettingComposer
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
        $model = new CategoryService(new Category());
        $categories = $model->getCategories(app()->getLocale());

        $view->with('address', $this->getValue('address'))
            ->with('contact_email', $this->getValue('contact_email'))
            ->with('categories', $categories)
            ->with('phone', $this->getValue('phone'))
            ->with('siteFacebook',$this->getValue('facebook'))
            ->with('siteInstagram',$this->getValue('instagram'))
            ->with('sitePayByCash',$this->getValue('pay_by_cash'))
            ->with('siteTransfer',$this->getValue('transfer'))
            ->with('sitePaymentByCard',$this->getValue('payment_by_card'))
            ->with('siteBankInstallment',$this->getValue('bank_installment'))
            ->with('siteInternalInstallment',$this->getValue('internal_installment'))
            ->with('siteRequisiteOne',$this->getValue('requisite_1'))
            ->with('siteRequisiteTwo',$this->getValue('requisite_2'))
        ;
    }

    protected function getValue($key)
    {
        $setting = Setting::where('key', $key)->first();
        if ($setting == null) {
            return '';
        }
        if (count($setting->availableLanguage) < 1) {
            return '';
        }
        return $setting->availableLanguage[0]->value;
    }

}
