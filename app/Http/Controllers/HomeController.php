<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\SliderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Polyfill\Ctype\Ctype;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     *
     * @return Application
     */
    public function index(string $lang, Request $request)
    {
        $page = Page::where(['status' => true, 'slug' => 'home'])->first();
//        if (!$page) {
//            return abort('404');
//        }


//        $vipProducts = Product::inRandomOrder()->where('vip', true)->limit(15)->get();
        $popularProducts = Product::inRandomOrder()->limit(10)->get();

        $model = new ProductService(new Product());
        $modelSlider = new SliderService(new Slider());
        $newProductsCategory = [];
        $discountedProductsCategory = [];
        $vipProductsCategory = [];
        $newProducts = $model->getLastProducts();

        foreach ($newProducts as $product) {
            foreach ($product->answers as $answer) {
                if ($answer->answer->feature->feature->slug == "category") {
                    if (count($answer->answer->availableLanguage) > 0) {
                        $newProductsCategory[] = $answer->answer->availableLanguage[0];
                    }
                }
            }
        }
        $newProductsCategory = array_unique(array_column($newProductsCategory, 'title', 'id'));

        $discountedProducts = $model->discountedProducts();

        foreach ($discountedProducts as $product) {
            foreach ($product->answers as $answer) {
                if ($answer->answer->feature->feature->slug == "category") {
                    if (count($answer->answer->availableLanguage) > 0) {
                        $discountedProductsCategory[] = $answer->answer->availableLanguage[0];
                    }
                }
            }
        }

        $discountedProductsCategory = array_unique(array_column($discountedProductsCategory, 'title', 'id'));


        $vipProducts = $model->vipProducts();
        foreach ($vipProducts as $product) {
            foreach ($product->answers as $answer) {
                if ($answer->answer->feature->feature->slug == "category") {
                    if (count($answer->answer->availableLanguage) > 0) {
                        $vipProductsCategory[] = $answer->answer->availableLanguage[0];
                    }
                }
            }
        }
        $vipProductsCategory = array_unique(array_column($vipProductsCategory, 'title', 'id'));

        $latestProducts= $model->latestProducts();
        $additionalCategories = $model->getHomePageCategories();
        $sliders = $modelSlider->heroSlider();
        $brands = $model->getBrands();

        $banner = Slider::where('type','banner')->first();
        $secondBanner = Slider::where('type','second_banner')->first();
        return view('pages.home.home', [
            'page' => $page,
            'vipProducts' => $vipProducts,
            'popularProducts' => $popularProducts,
            'newProducts' => $newProducts,
            'discountedProducts' => $discountedProducts,
            'latestProducts' => $latestProducts,
            'additionalCategories' => $additionalCategories,
            'newProductsCategory' => $newProductsCategory,
            'discountedProductsCategory' => $discountedProductsCategory,
            'vipProductsCategory' => $vipProductsCategory,
            'sliders' => $sliders,
            'brands' => $brands,
            'banner' => $banner,
            'secondBanner' => $secondBanner
        ]);
    }
}
