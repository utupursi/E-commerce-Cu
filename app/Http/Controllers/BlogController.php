<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\NewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     *
     * @return Application|Factory|View
     */
    public function index(string $lang, Request $request){
        $request->merge([
            'per_page' => 8
        ]);
        return view('pages.blog.index',[
            'news' => $this->service->getAll($lang,$request)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @param string $locale
     * @return Application|Factory|View
     */
    public function show(string $locale, string $slug)
    {
        $new = $this->service->findBySlug($slug);
        $otherNews = News::inRandomOrder()->where([['status','=',true],['id','!=',$new->id]])->limit(3)->get();
        return view('pages.blog.show', [
            'new' => $new,
            'otherNews' => $otherNews
        ]);
    }
}
