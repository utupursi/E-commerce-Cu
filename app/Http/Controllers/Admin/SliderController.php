<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\BrandRequest;
use App\Http\Request\Admin\CategoryRequest;
use App\Http\Request\Admin\SliderRequest;
use App\Models\Category;
use App\Models\Localization;
use App\Services\CategoryService;
use App\Services\SliderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class SliderController extends AdminController
{
    protected $service;

    public function __construct(SliderService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     * @param Request $request
     * @return Response
     */
    public function index(string $lang, Request $request)
    {
        $request->validate([
            'id' => 'integer|nullable',
            'title' => 'string|max:255|nullable',
            'slug' => 'string|max:255|nullable',
            'status' => 'boolean|nullable',
        ]);

        return view('admin.modules.slider.index', [
            'sliders' => $this->service->getAll($lang, $request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function create(string $locale)
    {
        return view('admin.modules.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(string $locale, SliderRequest $request)
    {
        if (!$this->service->store($locale, $request)) {
            return redirect(route('sliderCreateView', $locale))->with('danger', 'Slider does not create.');
        }

        return redirect(route('sliderIndex', $locale))->with('success', 'Slider create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $slider
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id)
    {
        return view('admin.modules.slider.show', [
            'slider' => $this->service->find($id)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $slider
     * @return Application|Factory|View|Response
     */
    public function edit(string $locale, int $id)
    {
        return view('admin.modules.slider.update', [
            'slider' => $this->service->find($id)
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $locale
     * @param CategoryRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(string $locale, SliderRequest $request, int $id)
    {
        if (!$this->service->update($locale, $id, $request)) {
            return redirect(route('sliderEditView', $locale))->with('danger', 'Slider does not update.');
        }

        return redirect(route('sliderIndex', $locale))->with('success', 'Slider update successfully.');

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
            return redirect(route('sliderIndex', $locale))->with('danger', 'Slider does not delete.');
        }
        return redirect(route('sliderIndex', $locale))->with('success', 'Slider delete successfully.');

    }
}
