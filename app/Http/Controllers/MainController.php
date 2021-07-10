<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\SliderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Polyfill\Ctype\Ctype;
use App\Http\Request\ProfileRequest;
use App\Http\Request\PasswordRequest;
use App\Models\Localization;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\UserLanguage;

class MainController extends Controller
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

//        foreach ($newProducts as $product) {
//            foreach ($product->answers as $answer) {
//                if ($answer->answer->feature->feature->slug == "category") {
//                    if (count($answer->answer->availableLanguage) > 0) {
//                        $newProductsCategory[] = $answer->answer->availableLanguage[0];
//                    }
//                }
//            }
//        }
//        $newProductsCategory = array_unique(array_column($newProductsCategory, 'title', 'id'));

        $discountedProducts = $model->discountedProducts();
//
//        foreach ($discountedProducts as $product) {
//            foreach ($product->answers as $answer) {
//                if ($answer->answer->feature->feature->slug == "category") {
//                    if (count($answer->answer->availableLanguage) > 0) {
//                        $discountedProductsCategory[] = $answer->answer->availableLanguage[0];
//                    }
//                }
//            }
//        }
//
//        $discountedProductsCategory = array_unique(array_column($discountedProductsCategory, 'title', 'id'));


        $vipProducts = $model->vipProducts();
//        foreach ($vipProducts as $product) {
//            foreach ($product->answers as $answer) {
//                if ($answer->answer->feature->feature->slug == "category") {
//                    if (count($answer->answer->availableLanguage) > 0) {
//                        $vipProductsCategory[] = $answer->answer->availableLanguage[0];
//                    }
//                }
//            }
//        }
//        $vipProductsCategory = array_unique(array_column($vipProductsCategory, 'title', 'id'));

        $latestProducts = $model->latestProducts();
        $additionalCategories = $model->getHomePageCategories();
        $sliders = $modelSlider->heroSlider();
        $brands = $model->getBrands();

        $banner = Slider::where('type', 'banner')->first();
        $secondBanner = Slider::where('type', 'second_banner')->first();
        return view('pages.home.home', [
            'page' => $page,
//            'vipProducts' => $vipProducts,
            'popularProducts' => $popularProducts,
            'newProducts' => $newProducts,
            'discountedProducts' => $discountedProducts,
            'latestProducts' => $latestProducts,
            'additionalCategories' => $additionalCategories,
//            'newProductsCategory' => $newProductsCategory,
//            'discountedProductsCategory' => $discountedProductsCategory,
            'vipProductsCategory' => $vipProductsCategory,
            'sliders' => $sliders,
            'brands' => $brands,
            'banner' => $banner,
            'secondBanner' => $secondBanner
        ]);
    }

    public function userAccount()
    {
        $userOrders = Order::where(['user_id' => auth()->user()->id])->paginate(10);
        if (!$userOrders) {
            abort(404);
        }
        return view('pages.user.my-account', [
            'orders' => $userOrders
        ]);
    }

    public function userProducts(string $locale, int $orderId)
    {
        $orderProducts = Order::where(['id' => $orderId,'user_id'=>auth()->user()->id])
            ->with(['products.product.availableLanguage'])
            ->first();
        if (!$orderProducts) {
            abort(404);
        }
        return view('pages.user.user-products', [
            'order' => $orderProducts
        ]);
    }

    public function changePassword(){

    }


    public function updateProfile(string $lang,ProfileRequest $request){
    
        $localization = Localization::where('abbreviation', $lang)->first();

        $user=User::find(auth()->user()->id);
        $userLanguage=UserLanguage::where(['language_id'=>$localization->id,'user_id'=>auth()->user()->id])->first();
        if($userLanguage){
          $userLanguage->update([
            'first_name'=>$request['first_name'],
            'last_name'=>$request['last_name'],
            'address'=>$request['address']
          ]);
        }
        else{
          UserLanguage::create([
            'language_id'=>$localization->id,
            'user_id'=>auth()->user()->id,
            'first_name'=>$request['first_name'],
            'last_name'=>$request['last_name'],
            'address'=>$request['address']
          ]);
    }


        return redirect()->route('myAccount',$lang)->with('success','პროფილი წარმატებულად განახლდა');

    }

    public function changeUserPassword(string $lang,PasswordRequest $request){
        $user=User::find(auth()->user()->id);
        $userUpdate=$user->update([
           'password'=> Hash::make($request->new_password)
        ]);

        if($userUpdate){
           return redirect()->route('myAccount',$lang)->with('success','პაროლი წარმატებულად შეიცვალა');
        }
        return redirect()->route('myAccount',$lang)->with('dange','პაროლი არ შეიცვალა');



    }
}

