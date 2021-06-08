<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Localization;
use App\Models\Product;
use App\Models\ProductAnswers;
use App\Models\ProductFeatures;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{

    public function club()
    {
        return view('pages.club');
    }
     
    // Blog
    public function blog()
    {
        return view('pages.blog');
    }
    public function blogshow($id)
    {
        return view('pages.blog_details');
    }

}
