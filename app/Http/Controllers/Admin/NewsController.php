<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Request\Admin\NewsRequest;
use App\Models\Localization;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends AdminController
{
    protected $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale, Request $request)
    {
        $localization = Localization::where('abbreviation',$locale)->first()->id;
        return view('admin.modules.news.index', ['news' => $this->service->getAll($locale, $request), 'locale'=>$locale, 'localization' => $localization]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale)
    {
        $localization = Localization::where('abbreviation',$locale)->first()->id;
        return view('admin.modules.news.create', ['locale'=>$locale, 'localization' => $localization]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request, $locale)
    {
        $data = $request->only([
            'title',
            'description',
            'file',
            'content' ,
            'section',
            'position' ,
            'status' ,
            'slug'
        ]);
        
        $this->service->store($locale, $data);

        return redirect()->route('NewsIndex', compact('locale'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $localization = Localization::where('abbreviation',$locale)->first()->id;
        return view('admin.modules.news.edit', ['news'=> $this->service->find(intval($id)),'locale'=>$locale, 'localization' => $localization]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale, $id)
    {
        // sxvanairad ver avamushave validacia unique ze
        $this->validate($request, [
            
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'file' => 'nullable|mimes:jpg,jpeg,png',
            'content' => 'nullable|string',
            'section' => 'nullable|string',
            'position' => 'nullable|string|max:255',
            'status' => 'required|integer',
            'slug' => 'required',
        ]);
        $data = $request->only([
            'title',
            'description',
            'file',
            'content' ,
            'section' ,
            'position' ,
            'status' ,
            'slug'
        ]);
        $this->service->update($locale, $data, $id);

        return redirect()->route('NewsIndex', compact('locale'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->service->delete($id);

        return redirect()->route('NewsIndex', compact('locale'));
    }
}
