<?php
/**
 *  app/Http/Controllers/Admin/LocalizationController.php
 *
 * User: 
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\LocalizationRequest;
use App\Services\LocalizationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class LocalizationController extends AdminController
{
    protected $service;

    public function __construct(LocalizationService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'integer|nullable',
            'title' => 'string|max:255|nullable',
            'abbreviation' => 'string|max:255|nullable',
            'native' => 'string|max:255|nullable',
            'localization' => 'string|max:255|nullable',
            'status' => 'boolean|nullable',
        ]);
        return view('admin.modules.localization.index', [
            'localizations' => $this->service->getAll($request)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.modules.localization.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(LocalizationRequest $request)
    {
        $data = $request->only([
            'title',
            'abbreviation',
            'native',
            'locale',
            'status',
            'default'
        ]);

        if (!$this->service->store($data)) {
            return redirect(route('localizationCreateView'))->with('danger', 'Localization does not create.');
        }

        return redirect(route('localizationIndex', app()->getLocale()))->with('success', 'Localization create successfully.');

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
        return view('admin.modules.localization.show', [
            'localization' => $this->service->find($id)
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
        return view('admin.modules.localization.update', [
            'localization' => $this->service->find($id)
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param LocalizationRequest $request
     * @param string $locale
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(string $locale, LocalizationRequest $request, int $id)
    {
        $data = $request->only([
            'title',
            'abbreviation',
            'native',
            'locale',
            'status',
            'default'
        ]);


        if (!$this->service->update($id, $data)) {
            return redirect(route('localizationEditView', $locale))->with('danger', 'Localization does not update.');
        }

        return redirect(route('localizationIndex', $locale))->with('success', 'Localization update successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $locale
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(string $locale, int $id)
    {
        if (!$this->service->delete($id)) {
            return redirect(route('localizationIndex', $locale))->with('danger', 'Localization is default.');
        }
        return redirect(route('localizationIndex', $locale))->with('success', 'Localization delete successfully.');

    }
}
