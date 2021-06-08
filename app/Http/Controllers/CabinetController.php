<?php
/**
 *  app/Http/Controllers/CabinetController.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 17:53
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Controllers;

use App\Http\Request\Admin\UserCabinetRequest;
use App\Models\Localization;
use App\Services\UserService;

class CabinetController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function cabinetinfo()
    {
        return view('pages.cabinet.cabinet_info',[
            'user' => $this->service->find(Auth()->user()->id)
        ]);
    }
    public function cabinetorders()
    {
        $localization = Localization::where('abbreviation', app()->getLocale())->first()->id ?? 1;
        return view('pages.cabinet_orders', [
            'localization' => $localization,
            'user' => $this->service->find(Auth()->user()->id)
        ]);
    }
    public function cabinetInfoUpdate($locale, UserCabinetRequest $request,int $id)
    {
        if (!$this->service->update($locale,$id,$request)) {
            return redirect(route('cabinetInfo',$locale));
        }
        return redirect(route('cabinetInfo', $locale));
    }
}
