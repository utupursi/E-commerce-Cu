<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\BrandRequest;
use App\Http\Request\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Localization;
use App\Services\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class CategoryController extends AdminController
{
    protected $service;

    public function __construct(CategoryService $service)
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

        return view('admin.modules.category.index', [
            'categoriesLocal' => $this->service->getAll($lang, $request)
        ]);
    }

//    public function getChildCategories(string $lang, Request $request)
//    {
//        $request->validate([
//            'id' => 'integer|nullable',
//            'title' => 'string|max:255|nullable',
//            'slug' => 'string|max:255|nullable',
//            'status' => 'boolean|nullable',
//        ]);
//
//        return view('admin.modules.sub-category.index', [
//            'categories' => $this->service->getAll($lang, $request)
//        ]);
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function create(string $locale)
    {
        return view('admin.modules.category.create');
    }

//    /**
//     * @param string $lang
//     * @return Application|Factory|View|Response
//     */
//    public function createChildCategory(string $locale)
//    {
//        $categories = $this->service->getCategories($locale);
//
//        return view('admin.modules.sub-category.create')->with(['categories' => $categories]);
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(string $locale, CategoryRequest $request)
    {
        if (!$this->service->store($locale, $request)) {
            return redirect(route('categoryCreateView', $locale))->with('danger', 'Category does not create.');
        }

        return redirect(route('categoryIndex', $locale))->with('success', 'Category create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $cateogry
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id)
    {
        return view('admin.modules.category.show', [
            'category' => $this->service->find($id)
        ]);
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param \App\Models\Category $cateogry
//     * @return Application|Factory|View|Response
//     */
//    public function showChildCategory(string $locale, int $id)
//    {
//        return view('admin.modules.sub-category.show', [
//            'category' => $this->service->find($id)
//        ]);
//    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return Application|Factory|View|Response
     */
    public function edit(string $locale, int $id)
    {
        return view('admin.modules.category.update', [
            'category' => $this->service->find($id)
        ]);

    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param \App\Models\Category $category
//     * @return Application|Factory|View|Response
//     */
//
//    public function editChildCategory(string $locale, int $id)
//    {
//        $categories = $this->service->getCategories($locale);
//
//        return view('admin.modules.sub-category.update', [
//            'category' => $this->service->find($id),
//            'parentCategories' => $categories
//        ]);
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $locale
     * @param CategoryRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(string $locale, CategoryRequest $request, int $id)
    {
        if (!$this->service->update($locale, $id, $request)) {
            return redirect(route('categoryEditView', $locale))->with('danger', 'Category does not update.');
        }

        return redirect(route('categoryIndex', $locale))->with('success', 'Category update successfully.');

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
            return redirect(route('categoryIndex', $locale))->with('danger', 'Category does not delete.');
        }
        return redirect(route('categoryIndex', $locale))->with('success', 'Category delete successfully.');

    }

//    public function destroyChildCategory(string $locale, int $id)
//    {
//        if (!$this->service->delete($id)) {
//            return redirect(route('subCategoryIndex', $locale))->with('danger', 'Category does not delete.');
//        }
//        return redirect(route('subCategoryIndex', $locale))->with('success', 'Category delete successfully.');
//
//    }
}
