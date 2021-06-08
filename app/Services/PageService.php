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

use App\Http\Request\Admin\PageRequest;
use App\Models\Feature;
use App\Models\Localization;
use App\Models\Page;
use App\Models\PageLanguage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class PageService
{
    protected $model;

    protected $perPageArray = [10, 20, 30, 50, 100];

    public function __construct(Page $model)
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
     * Get Page.
     *
     * @param string $lang
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public function getAll(string $lang,$request)
    {
        $data = $this->model->query();

        $localizationID = Localization::getIdByName($lang);

        if ($request->id) {
            $data = $data->where('id',$request->id);
        }

        if ($request->title) {
            $data = $data->with('language')->whereHas('language', function ($query) use ($localizationID, $request) {
                $query->where('title','like',"%{$request->title}%")->where('language_id',$localizationID);
            });
        }

        if ($request->slug) {
            $data = $data->where('slug', 'like', "%{$request->slug}%");
        }
        if ($request->status != null) {
            $data = $data->where('status',$request->status);
        }


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
    public function store(string $lang, array $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;

        $localizationID = Localization::getIdByName($lang);


        $this->model = new Page([
            'slug' => $request['slug'],
            'status' => $request['status']
        ]);

        $this->model->save();

        $this->model->language()->create([
            'page_id' => $this->model->id,
            'language_id' => $localizationID,
            'title' => $request['title'],
            'meta_title' => $request['meta_title'],
            'description' => $request['description'],
            'content' => $request['content'],
            'content_2' => $request['content_2'],
            'content_3' => $request['content_3'],
            'content_4' => $request['content_4'],
        ]);

        return true;
    }

    /**
     * Update Page item.
     *
     * @param string $lang
     * @param int $id
     * @param PageRequest $request
     * @return bool
     */
    public function update(string $lang,int $id, PageRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;
        $data = $this->find($id);
        $data->update([
            'slug' => $request['slug'],
            'status' => $request['status']
        ]);

        $localizationID = Localization::getIdByName($lang);

        $featureLanguage = PageLanguage::where(['page_id' => $data->id, 'language_id' => $localizationID])->first();

        if ($featureLanguage == null) {
            $data->language()->create([
                'page_id' => $this->model->id,
                'language_id' => $localizationID,
                'title' => $request['title'],
                'meta_title' => $request['meta_title'],
                'description' => $request['description'],
                'content' => $request['content'],
                'content_2' => $request['content_2'],
                'content_3' => $request['content_3'],
                'content_4' => $request['content_4'],
            ]);
        } else {
            $featureLanguage->title = $request['title'];
            $featureLanguage->meta_title = $request['meta_title'];
            $featureLanguage->description = $request['description'];
            $featureLanguage->content = $request['content'];
            $featureLanguage->content_2 = $request['content_2'];
            $featureLanguage->content_3 = $request['content_3'];
            $featureLanguage->content_4 = $request['content_4'];
            $featureLanguage->save();
        }

        // Delete page file if deleted in request.
        if (count($data->files) > 0) {
            foreach ($data->files as $file) {
                if ($request['old_images'] == null) {
                    $file->delete();
                    continue;
                }
                if (!in_array($file->id,$request['old_images'])) {
                    if (Storage::exists('public_html/page/' . $data->id.'/'.$file->name)) {
                        Storage::delete('public_html/page/' . $data->id.'/'.$file->name);
                    }
                    $file->delete();

                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $imagename = date('Ymhs') . $file->getClientOriginalName();
                $destination = base_path() . '/storage/app/public_html/page/' . $data->id;
                $request->file('images')[$key]->move($destination, $imagename);
                $data->files()->create([
                    'name' => $imagename,
                    'path' => '/storage/app/public_html/page/' . $data->id,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return true;
    }

}
