<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAnswers;
use App\Services\ProductService;
use Illuminate\Contracts\Console\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Socialite\Contracts\Factory;

class CatalogueController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     * @param Request $request
     * @param Category $category
     *
     * @return Application|Factory|View
     */
    public function catalogue(string $lang, Request $request, Category $category)
    {
        $data = $this->service->getAll($lang,$request,$category->id,false);

        $filterArrays = $this->getFilters($data);

        if (count($filterArrays['productFeatures']) < 1) {
            $filterArrays = $this->getFilters($this->service->getAll($lang,$request,$category->id,false,false));
        }

        $data = $data->orderBy('id', 'DESC')->paginate(12);

        $staticFilterData = ['category'];


        return view('pages.product.catalogue',[
            'products' => $data,
            'category' => $category,
            'staticFilterData' =>$staticFilterData,
            'productFeatures' => $filterArrays['productFeatures'],
            'productAnswers' => $filterArrays['productAnswers'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $locale
     * @param Category $category
     * @param Product $product
     *
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, Category $category, Product $product)
    {
        if (0 === $product->status) {
            abort(404);
        }
        $newProductsCategory = [];
        $model = new ProductService(new Product());
        $newProducts = $model->getLastProducts();

        foreach ($newProducts as $prod) {
            foreach ($prod->answers as $answer) {
                if ($answer->answer->feature->feature->slug == "category") {
                    if (count($answer->answer->availableLanguage) > 0) {
                        $newProductsCategory[] = $answer->answer->availableLanguage[0];
                    }
                }
            }
        }
        $newProductsCategory = array_unique(array_column($newProductsCategory, 'title', 'id'));
        return view('pages.product.details',[
            'product' => $product,
            'category' => $category,
            'newProducts' => $newProducts,
            'newProductsCategory' => $newProductsCategory
        ]);
    }

    protected function getFilters($data): array
    {
        $productIdArrays = $data->orderBy('id', 'DESC')->get()->pluck('id')->toArray();

        $filterData  = ProductAnswers::with('feature')->whereIn('product_id',$productIdArrays);
        $productFeatures = $filterData
            ->groupBy('feature_id')
            ->get()
            ->sortBy(function($query){
                return $query->feature->position;
            });
        $productAnswers = $filterData->groupBy('answer_id')->get()->pluck('answer_id')->toArray();

        return [
            'productFeatures' =>$productFeatures,
            'productAnswers' => $productAnswers
        ];
    }
}
