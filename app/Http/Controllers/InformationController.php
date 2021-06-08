<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     *
     * @return Application|Factory|View
     */
    public function warranty(string $lang)
    {
        $page = Page::where(['status' => true, 'slug' => 'warranty'])->first();
        if (!$page) {
            return abort('404');
        }

        return view('pages.information.warranty', [
            'page' => $page
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     *
     * @return Application|Factory|View
     */
    public function privacyPolicy(string $lang)
    {
        $page = Page::where(['status' => true, 'slug' => 'privacy-policy'])->first();
        if (!$page) {
            return abort('404');
        }

        return view('pages.information.privacy-policy',[
            'page' => $page
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     *
     * @return Application|Factory|View
     */
    public function deliveryInfo(string $lang)
    {
        $page = Page::where(['status' => true, 'slug' => 'delivery-info'])->first();
        if (!$page) {
            return abort('404');
        }
        return view('pages.information.delivery-info',[
            'page' => $page
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     *
     * @return Application|Factory|View
     */
    public function paymentInfo(string $lang)
    {
        $page = Page::where(['status' => true, 'slug' => 'payment-info'])->first();
        if (!$page) {
            return abort('404');
        }

        return view('pages.information.payment-info',[
            'page' => $page
        ]);
    }
}
