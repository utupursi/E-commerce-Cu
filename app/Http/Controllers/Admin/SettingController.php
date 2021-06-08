<?php
/**
 *  app/Http/Controllers/Admin/SettingController.php
 *
 * User: 
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\FeatureRequest;
use App\Http\Request\Admin\PageRequest;
use App\Http\Request\Admin\SettingRequest;
use App\Services\PageService;
use App\Services\SettingService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class SettingController extends AdminController
{
    protected $service;

    public function __construct(SettingService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     * @param string $lang
     * @return Application|Factory|View|Response
     */
    public function index(string $lang, Request $request)
    {
        $request->validate([
            'id' => 'integer|nullable',
            'key' => 'string|max:255|nullable',
            'value' => 'string|max:255|nullable',
        ]);
        return view('admin.modules.setting.index', [
            'settings' => $this->service->getAll($lang,$request)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.modules.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $lang
     * @param FeatureRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(string $locale, SettingRequest $request)
    {
        $data = $request->only([
            'key',
            'value'
        ]);

        if (!$this->service->store($locale,$data)) {
            return redirect(route('settingCreateView',$locale))->with('danger', 'Setting does not create.');
        }

        return redirect(route('settingIndex', $locale))->with('success', 'Setting create successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id)
    {
        return view('admin.modules.setting.show', [
            'setting' => $this->service->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function edit(string $locale, int $id)
    {
        return view('admin.modules.setting.update', [
            'setting' => $this->service->find($id)
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param FeatureRequest $request
     * @param string $locale
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(string $locale, SettingRequest $request, int $id)
    {
        $data = $request->only([
            'key',
            'value'
        ]);


        if (!$this->service->update($locale, $id, $data)) {
            return redirect(route('settingEditView', $locale,$id))->with('danger', 'Setting does not update.');
        }

        return redirect(route('settingIndex', $locale))->with('success', 'Setting update successfully.');

    }
}
