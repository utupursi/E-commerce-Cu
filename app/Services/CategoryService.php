<?php
/**
 *  app/Services/PageService.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Services;

use App\Http\Request\Admin\CategoryRequest;
use App\Http\Request\Admin\PageRequest;
use App\Models\Brand;
use App\Models\BrandLanguage;
use App\Models\Category;
use App\Models\CategoryLanguage;
use App\Models\Feature;
use App\Models\Localization;
use App\Models\Page;
use App\Models\PageLanguage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    protected $model;

    protected $perPageArray = [10, 20, 30, 50, 100];

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Get Page by id.
     *
     * @param int $id
     * @return Feature
     */
    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get Brands.
     *
     * @param string $lang
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public function getAll(string $lang, $request)
    {
        $data = $this->model->query();

        $localizationID = Localization::getIdByName($lang);

        if ($request->id) {
            $data = $data->where('id', $request->id);
        }

        if ($request->title) {
            $data = $data->with('language')->whereHas('language', function ($query) use ($localizationID, $request) {
                $query->where('title', 'like', "%{$request->title}%")->where('language_id', $localizationID);
            });
        }

        if ($request->slug) {
            $data = $data->where('slug', 'like', "%{$request->slug}%");
        }
        if ($request->status != null) {
            $data = $data->where('status', $request->status);
        }


        // Check if perPage exist and validation by perPageArray [].
        $perPage = ($request->per_page != null && in_array($request->per_page, $this->perPageArray)) ? $request->per_page : 10;

        return $data->orderBy('id', 'DESC')->paginate($perPage);
    }


    /**
     * Create Feature item into db.
     *
     * @param string $lang
     * @param array $request
     * @return bool
     */
    public function store(string $lang, CategoryRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;

        $localizationID = Localization::getIdByName($lang);


        $this->model = new Category([
            'slug' => $request['slug'],
            'status' => $request['status'],
            'position' => $request['position'],
        ]);

        $this->model->save();

        $this->model->language()->create([
            'category_id' => $this->model->id,
            'language_id' => $localizationID,
            'title' => $request['title'],
            'description' => $request['description'],
        ]);

        $model = $this->model;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $imagename = date('Ymhs') . $file->getClientOriginalName();
                $destination = base_path() . '/storage/app/public/category/' . $this->model->id;
                $request->file('images')[$key]->move($destination, $imagename);
                $model->files()->create([
                    'name' => $imagename,
                    'path' => '/storage/app/public/category/' . $model->id,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }


        return true;
    }

    /**
     * Update Page item.
     *
     * @param string $lang
     * @param int $id
     * @param array $request
     * @return bool
     */
    public function update(string $lang, int $id, CategoryRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;
        $data = $this->find($id);
        $data->update([
            'slug' => $request['slug'],
            'position' => $request['position'],
            'status' => $request['status'],
        ]);

        $localizationID = Localization::getIdByName($lang);

        $categoryLanguage = CategoryLanguage::where(['category_id' => $data->id, 'language_id' => $localizationID])->first();

        if ($categoryLanguage == null) {
            $data->language()->create([
                'category_id' => $this->model->id,
                'language_id' => $localizationID,
                'title' => $request['title'],
                'description' => $request['description'],
            ]);
        } else {
            $categoryLanguage->title = $request['title'];
            $categoryLanguage->description = $request['description'];
            $categoryLanguage->save();
        }

        if (count($data->files) > 0) {
            foreach ($data->files as $file) {
                if ($request['old_images'] == null) {
                    $file->delete();
                    continue;
                }
                if (!in_array($file->id, $request['old_images'])) {
                    if (Storage::exists('public/category/' . $data->id . '/' . $file->name)) {
                        Storage::delete('public/category/' . $data->id . '/' . $file->name);
                    }
                    $file->delete();

                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $imagename = date('Ymhs') . $file->getClientOriginalName();
                $destination = base_path() . '/storage/app/public/category/' . $data->id;
                $request->file('images')[$key]->move($destination, $imagename);
                $data->files()->create([
                    'name' => $imagename,
                    'path' => '/storage/app/public/category/' . $data->id,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return true;
    }

    /**
     * Delete brand item from db.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id)
    {
        $data = $this->find($id);
        if (count($data->language) > 0) {
            if (!$data->language()->delete()) {
                throwException('Category languages can not delete.');
            }
        }
        if (count($data->files) > 0) {
            if (Storage::exists('public/category/' . $data->id)) {
                Storage::deleteDirectory('public/category/' . $data->id);
            }
            $data->files()->delete();
        }

        if (!$data->delete()) {
            throwException('Category  can not delete.');
        }
        return true;
    }

    public function getCategories($locale)
    {
        $localizationID = Localization::getIdByName($locale);

        return Category::whereHas('language', function ($query) use ($localizationID) {
            $query->where('language_id', $localizationID);
        })->get();
    }
}
