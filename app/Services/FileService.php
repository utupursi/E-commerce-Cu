<?php

namespace App\Services;

use App\Models\Feature;
use App\Models\File;
use App\Models\Localization;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\throwException;

class FileService
{
    protected $model;

    protected $perPageArray = [10, 20, 30, 50, 100];

    public function __construct(File $model)
    {
        $this->model = $model;
    }

    /**
     * Get Feature by id.
     *
     * @param int $id
     * @return Feature
     */
    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get Features.
     *
     * @param string $lang
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public function getAll(string $lang, $request)
    {
        $data = $this->model->query();
        $data = $data->whereNull('fileable_type')->orWhere('fileable_type', 'LIKE', 'App\Models\News');
        // Check if perPage exist and validation by perPageArray [].
        $perPage = ($request->per_page != null && in_array($request->per_page,$this->perPageArray)) ? $request->per_page : 10;

        return $data->orderBy('id', 'DESC')->paginate($perPage);
    }


    /**
     * Create Feature item into db.
     *
     * @param string $lang
     * @param array $request
     * @return bool
     */
    public function store(array $request)
    {
        $filename = 'time-' . time() . '.' . $request['file']->getClientOriginalExtension();
        Storage::disk('public_html')->putFileAs("files/", $request['file'], $filename);
        $this->model->create([
            'name' => $filename,
            'path' => 'files/',
            'format' => $request['file']->getClientOriginalExtension(),
        ]);

        return true;
    }


    /**
     * Create localization item into db.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id)
    {
        $file = $this->find($id);
       
        Storage::disk('public_html')->delete($file->path.'/'.$file->name);
        $file->delete();
        return true;
    }
}
