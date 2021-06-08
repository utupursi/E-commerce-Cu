<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\BrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class BrandController extends AdminController
{
    protected $service;

    public function __construct(BrandService $service)
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

        return view('admin.modules.brand.index', [
            'brands' => $this->service->getAll($lang,$request)
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
        return view('admin.modules.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(string $locale, BrandRequest $request)
    {
        if (!$this->service->store($locale,$request)) {
            return redirect(route('brandCreateView',$locale))->with('danger', 'Brand does not create.');
        }

        return redirect(route('brandIndex', $locale))->with('success', 'Brand create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id)
    {
        return view('admin.modules.brand.show', [
            'brand' => $this->service->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return Application|Factory|View|Response
     */
    public function edit(string $locale, int $id)
    {
        return view('admin.modules.brand.update', [
            'brand' => $this->service->find($id)
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $locale
     * @param BrandRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(string $locale, BrandRequest $request, int $id)
    {
        if (!$this->service->update($locale, $id, $request)) {
            return redirect(route('brandEditView', $locale))->with('danger', 'Brand does not update.');
        }

        return redirect(route('brandIndex', $locale))->with('success', 'Brand update successfully.');

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
            return redirect(route('brandIndex', $locale))->with('danger', 'Brand does not delete.');
        }
        return redirect(route('brandIndex', $locale))->with('success', 'Brand delete successfully.');

    }
}
