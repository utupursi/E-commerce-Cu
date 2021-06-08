<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Localization;
use App\Models\Product;
use App\Models\ProductLanguage;
use App\Services\ProductService;
use Illuminate\Contracts\Console\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\Factory;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     */
    public function products(Request $request)
    {
        $answerId = $request->get('id');
        $type = $request->get('type');
        $answer = Answer::where(['id' => $answerId])->first();
        $results = [];

        if ($answer) {
            if ($type == "lastAdded") {
                $results = $answer->product()->orderBy('created_at', 'desc')->byLang()->take(10)->get();
            } elseif ($type == "discounted") {
                $results = $answer->product()->where(['sale' => 1])->byLang()->take(15)->get();
            } elseif ($type == "vip") {
                $results = $answer->product()->where(['vip' => 1])->byLang()->take(15)->get();
            }

            foreach ($results as $result) {
                if (count($result->availableLanguage) > 0) {
                    if (isset($result->files[0])) {
                        $result->availableLanguage[0]['file_name'] = $result->files[0]->name;
                    }
                    $result->availableLanguage[0]['category_id'] = $result->category_id;
                    $result->availableLanguage[0]['sale'] = $result->sale;
                    $result->availableLanguage[0]['price'] = $result->price;
                    $result->availableLanguage[0]['sale_price'] = $result->sale_price;
                    $result->availableLanguage[0]['cart_text'] = __('client.add_to_cart');
                    $array[] = $result->availableLanguage[0];
                }
            }

            return isset($array) ? response()->json($array) : response()->json(['text' => 'product not found'], 403);
        }

        return response()->json(['text' => 'product not found'], 403);

    }

    public function searchProducts($lang, Request $request)
    {
        $products = $this->service->globalSearch($lang, $request, true);
        return response()->json($products);
    }

    public function globalSearch(string $lang, Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:255'
        ]);
        $products = $this->service->globalSearch($lang, $request);
        return view('pages.product.search', ['products' => $products]);
    }

}


