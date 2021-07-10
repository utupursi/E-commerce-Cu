<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DictionaryController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\LocalizationController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PurchaseController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => ['setlocale']
], function () {


    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            if (Auth::user() && Auth::user()->can('isAdmin')) {
                return redirect(\route('productIndex', app()->getLocale()));
            } else {
                if (Auth::user()) {
                    return view('welcome');
                } else {
                    return redirect()->route('login-view', app()->getLocale());
                }
            }
        })->name('adminHome');

        Route::get('login', [AuthController::class, 'loginView'])->name('login-view');
        Route::middleware(['auth', 'can:isAdmin'])->group(function () {


            // Files
            Route::get('/files', [FileController::class, 'index'])->name('fileIndex');
            Route::get('/files/create', [FileController::class, 'create'])->name('FileCreate');
            Route::post('/files/store', [FileController::class, 'store'])->name('FileStore');
            Route::get('/removeimage/{file}', [FileController::class, 'remove'])->name('removeImage');

            // Localizations
            Route::resource('localizations', LocalizationController::class)
                ->name('index', 'localizationIndex')
                ->name('create', 'localizationCreateView')
                ->name('store', 'localizationCreate')
                ->name('edit', 'localizationEditView')
                ->name('update', 'localizationUpdate')
                ->name('destroy', 'localizationDestroy')
                ->name('show', 'localizationShow');

            // Features
            Route::resource('features', FeatureController::class)
                ->name('index', 'featureIndex')
                ->name('create', 'featureCreateView')
                ->name('store', 'featureCreate')
                ->name('edit', 'featureEditView')
                ->name('update', 'featureUpdate')
                ->name('destroy', 'featureDestroy')
                ->name('show', 'featureShow');

            // Language
            Route::resource('languages', DictionaryController::class)
                ->name('index', 'DictionaryIndex')
                ->name('store', 'DictionaryStore')
                ->name('create', 'DictionaryCreate')
                ->name('show', 'DictionaryShow')
                ->name('edit', 'DictionaryEdit')
                ->name('update', 'DictionaryUpdate')
                ->name('destroy', 'DictionaryDestroy');

            Route::get('language/rescan', [DictionaryController::class, 'rescan'])->name('languageScanner');

            // Answers
            Route::resource('answers', AnswerController::class)
                ->name('index', 'AnswerIndex')
                ->name('store', 'AnswerStore')
                ->name('show', 'AnswerShow')
                ->name('create', 'AnswerCreate')
                ->name('edit', 'AnswerEdit')
                ->name('update', 'AnswerUpdate')
                ->name('destroy', 'AnswerDestroy');
            // News
            Route::resource('news', NewsController::class)
                ->name('index', 'NewsIndex')
                ->name('store', 'NewsStore')
                ->name('show', 'NewsShow')
                ->name('create', 'NewsCreate')
                ->name('edit', 'NewsEdit')
                ->name('update', 'NewsUpdate')
                ->name('destroy', 'NewsDestroy');

            // Products
            Route::resource('products', ProductController::class)
                ->name('index', 'productIndex')
                ->name('create', 'productCreateView')
                ->name('store', 'productCreate')
                ->name('edit', 'productEditView')
                ->name('update', 'productUpdate')
                ->name('destroy', 'productDestroy');

            Route::get('products/{product}', [ProductController::class, 'showAdmin'])->name('productShow');

            // Users
            Route::resource('users', UserController::class)
                ->name('index', 'userIndex')
                ->name('create', 'userCreateView')
                ->name('store', 'userCreate')
                ->name('edit', 'userEditView')
                ->name('update', 'userUpdate')
                ->name('destroy', 'userDestroy')
                ->name('show', 'userShow');

            // Pages
            Route::resource('pages', PageController::class)->except('destroy')
                ->name('index', 'pageIndex')
                ->name('create', 'pageCreateView')
                ->name('store', 'pageCreate')
                ->name('edit', 'pageEditView')
                ->name('update', 'pageUpdate')
                ->name('show', 'pageShow');

            // Settings
            Route::resource('settings', SettingController::class)->except('destroy')
                ->name('index', 'settingIndex')
                ->name('create', 'settingCreateView')
                ->name('store', 'settingCreate')
                ->name('edit', 'settingEditView')
                ->name('update', 'settingUpdate')
                ->name('show', 'settingShow');


            // Brands
            Route::resource('brands', BrandController::class)
                ->name('index', 'brandIndex')
                ->name('create', 'brandCreateView')
                ->name('store', 'brandCreate')
                ->name('edit', 'brandEditView')
                ->name('update', 'brandUpdate')
                ->name('destroy', 'brandDestroy')
                ->name('show', 'brandShow');

            Route::resource('category', CategoryController::class)
                ->name('index', 'categoryIndex')
                ->name('create', 'categoryCreateView')
                ->name('store', 'categoryCreate')
                ->name('edit', 'categoryEditView')
                ->name('update', 'categoryUpdate')
                ->name('destroy', 'categoryDestroy')
                ->name('show', 'categoryShow');

            Route::resource('slider', SliderController::class)
                ->name('index', 'sliderIndex')
                ->name('create', 'sliderCreateView')
                ->name('store', 'sliderCreate')
                ->name('edit', 'sliderEditView')
                ->name('update', 'sliderUpdate')
                ->name('destroy', 'sliderDestroy')
                ->name('show', 'sliderShow');

            Route::resource('order', OrderController::class)
                ->name('index', 'orderIndex')
                ->name('edit', 'orderEditView')
                ->name('update', 'orderUpdate')
                ->name('show', 'orderShow');
        });

//        Route::get('subCategory', [CategoryController::class, 'getChildCategories'])->name('subCategoryIndex');
//        Route::get('subCategory/create', [CategoryController::class, 'createChildCategory'])->name('subCategoryCreateView');
//        Route::get('subCategory/{id}/edit', [CategoryController::class, 'editChildCategory'])->name('subCategoryEditView');
//        Route::get('subCategory/{id}', [CategoryController::class, 'showChildCategory'])->name('subCategoryShow');
//        Route::delete('subCategory/{id}', [CategoryController::class, 'destroyChildCategory'])->name('subCategoryDestroy');


    });

    // User Rotes

    // Auth
    Route::post('/register', [AuthController::class, 'register'])->name('Register');
    Route::get('login', [AuthController::class, 'loginFrontend'])->name('loginFrontend');
    Route::get('register', [AuthController::class, 'registerFrontend'])->name('registerFrontend');

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/verifyaccount/{token}', [AuthController::class, 'verify'])->name('verify');

    Route::middleware(['active'])->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('welcome');

        Route::get('/facebook', [AuthController::class, 'facebook'])->name('loginfacebook');
        Route::get('/facebook/callback', [AuthController::class, 'facebookredirect'])->name('facebookredirect');

        Route::get('/google', [AuthController::class, 'google'])->name('google');
        Route::get('/google/callback', [AuthController::class, 'googleredirect'])->name('googleredirect');

        Route::get('/about-us', [AboutController::class, 'index'])->name('AboutUs');
        Route::get('/products', [ProductController::class, 'render'])->name('Products');
        Route::get('/product/{id}', [ProductController::class, 'show'])->name('ProductShow');

        Route::get('/club', [FrontController::class, 'club'])->name('Club');

        Route::get('/blog', [BlogController::class, 'index'])->name('Blog');
        Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('BlogShow');

        // Cabinet
        Route::get('/cabinet-info', [CabinetController::class, 'cabinetInfo'])->name('cabinetInfo');
        Route::put('/cabinet-info/{user}', [CabinetController::class, 'cabinetInfoUpdate'])->name('cabinetInfoUpdate');
        Route::get('/cabinet-orders', [CabinetController::class, 'cabinetorders'])->name('CabinetOrders');

        Route::match(['get', 'post'], '/contact-us', [ContactController::class, 'index'])->name('ContactUs');


        // Purchase
        Route::get('/purchase', [PurchaseController::class, 'index'])->name('Purchase');
        Route::post('/makepurchase', [PurchaseController::class, 'buy'])->name('makePurchase');

        // Cart Functions
        Route::get('/cart', [CartController::class, 'index'])->name('Cart');
        Route::get('/addcartcount/{id}/{type}', [CartController::class, 'addCartCount'])->name('addCartCount');
        Route::get('/removefromcart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
        Route::get('/addtocart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
        Route::get('/getcartcount', [CartController::class, 'getCartCount'])->name('getCartCount');
        Route::get('/buy/{product}', [CartController::class, 'productBuy'])->name('productBuy');



        // Favorite Functions
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('Favorites');
        Route::get('/addtofavorites/{id}', [FavoriteController::class, 'addToFavorites'])->name('addToFavorites');
        Route::get('/removefromfavorites/{id}', [FavoriteController::class, 'removeFromFavorites'])->name('removeFromFavorites');
        Route::get('/getfavoritecount', [FavoriteController::class, 'getFavoriteCount'])->name('getFavoriteCount');

//    Route::get('invoice',[InvoiceController::class,'index'])->name('getInvoice');


        Route::get('/information/warranty', [InformationController::class, 'warranty'])->name('warranty');
        Route::get('/information/privacy-policy', [InformationController::class, 'privacyPolicy'])->name('privacyPolicy');
        Route::get('/information/delivery-info', [InformationController::class, 'deliveryInfo'])->name('deliveryInfo');
        Route::get('/information/payment-info', [InformationController::class, 'paymentInfo'])->name('paymentInfo');

        Route::get('/catalogue/{category}', [CatalogueController::class, 'catalogue'])->name('Catalogue');
        Route::get('/catalogue/{category}/details/{product}', [CatalogueController::class, 'show'])->name('productDetails');
        Route::get('/details', [CatalogueController::class, 'details'])->name('Details');
        Route::get('/getProducts', [\App\Http\Controllers\ProductController::class, 'products'])->name('getProducts');
        Route::get('/searchProducts', [\App\Http\Controllers\ProductController::class, 'searchProducts'])->name('searchProducts');
        Route::get('/search', [\App\Http\Controllers\ProductController::class, 'globalSearch'])->name('globalSearch');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');



    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/my-account', [MainController::class, 'userAccount'])->name('myAccount');
        Route::get('/user-products/{orderId}', [MainController::class, 'userProducts'])->name('userProducts');
        Route::post('/saveOrder', [CartController::class, 'saveOrder'])->name('saveOrder');
        Route::put('/updateProfile', [MainController::class, 'updateProfile'])->name('updateProfile');
        Route::put('/passwordChange', [MainController::class, 'changeUserPassword'])->name('passwordChange');



    });

});


Route::get('/home', 'MainController@index')->name('home');
