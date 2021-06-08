<?php

namespace App\Http\Controllers\Admin;

use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends AdminController
{
    protected $service;

    public function __construct(FileService $service)
    {
        $this->service = $service;
    }
    public function index(Request $request, $locale)
    {
        return view('admin.modules.file.index', ['files' => $this->service->getAll($locale, $request), 'locale'=>$locale]);
    }
    public function create($locale)
    {
        return view('admin.modules.file.create', ['locale'=>$locale]);
    }
    public function store(Request $request, $locale)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);
        $data = $request->only([
            'file'
        ]);
        $this->service->store($data);
        return redirect()->route('fileIndex', $locale);
    }
    public function remove($locale, $id)
    {   
        $this->service->delete($id);
        return redirect()->back();
    }
}
