<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\AnswerRequest;
use App\Models\Answer;
use App\Models\Feature;
use App\Models\Localization;
use App\Services\AnswerService;
use Illuminate\Http\Request;

class AnswerController extends AdminController
{
    protected $service;

    public function __construct(AnswerService $service)
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
        $request->validate([
            'feature' => 'integer|nullable',
            'position' => 'string|nullable',
            'slug' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
            'status' => 'integer|nullable',
        ]);

        $features = Feature::all();
        $localization = Localization::where('abbreviation', $locale)->first()->id;
        return view('admin.modules.answer.index', ['answers' => $this->service->getAll($locale, $request), 'locale' => $locale, 'features' => $features, 'localization' => $localization]);
    }

    public function show($locale)
    {
        $localization = Localization::where('abbreviation', $locale)->first()->id;
        return view('admin.modules.answer.show', ['localization' => $localization, 'locale' => $locale,]);
    }

    public function create($locale)
    {
        $features = Feature::all();
        $localization = Localization::where('abbreviation', $locale)->first()->id;
        return view('admin.modules.answer.create', ['features' => $features, 'localization' => $localization, 'locale' => $locale,]);
    }

    public function edit($locale, $id)
    {
        $features = Feature::all();
        $localization = Localization::where('abbreviation', $locale)->first()->id;
        return view('admin.modules.answer.edit', ['answer' => $this->service->find($id), 'features' => $features, 'localization' => $localization, 'locale' => $locale,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request, $locale)
    {
        $this->service->store($locale, $request);
        return redirect()->route('AnswerIndex', compact('locale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function update(AnswerRequest $request, $locale, $id)
    {
        $this->validate($request, [
            'slug' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'feature' => 'required|integer',
            'status' => 'required|string|min:1|max:1'
        ]);

        $this->service->update($id, $locale, $request);
        return redirect()->route('AnswerIndex', compact('locale'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $this->service->delete($id);
        return redirect()->back();
    }
}
