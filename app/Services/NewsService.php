<?php

namespace App\Services;

use App\Models\Dictionary;
use App\Models\Feature;
use App\Models\Localization;
use App\Models\News;
use App\Models\NewsLanguage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\throwException;

class NewsService
{
    protected $model;

    protected $perPageArray = [8,10, 20, 30, 50, 100];

    public function __construct(News $model)
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
        return $this->model->where('id',$id)->firstOrFail();
    }

    /**
     * Get Feature by id.
     *
     * @param string $slug
     * @return News
     */
    public function findBySlug(string $slug)
    {
        return $this->model->where('slug',$slug)->firstOrFail();
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

        $localization = $this->getLocalization($lang);
        
        if ($request->id !== null) {
            $data = $data->where('id', $request->all()['id']);
        }
        if ($request->position !== null) {
            $data = $data->where('position', 'LIKE', '%'.$request->all()['position'].'%');
        }
        if ($request->slug !== null) {
            $data = $data->where('slug', 'LIKE', '%'.$request->all()['slug'].'%');
        }
        if ($request->title !== null) {
            $titlearray = NewsLanguage::select('news_id')->where([['title', 'LIKE', '%'.$request->all()['title'].'%'], ['language_id', $localization->id]])->get()->toArray();
            $data = $data->whereInd('id', $titlearray);
        }
        if ($request->description !== null) {
            $descriptionarr = NewsLanguage::select('news_id')->where([['description', 'LIKE', '%'.$request->all()['description'].'%'], ['language_id', $localization->id]])->get()->toArray();
            $data = $data->whereInd('id', $descriptionarr);
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
        $model = $this->model->create([
            'slug' => $request['slug'],
            'position' => $request['position'],
            'status' => intval($request['status']),
        ]);
        if(isset($request['file'])){
            $filename = 'time-' . time() . '.' . $request['file']->getClientOriginalExtension();
            Storage::disk('public_html')->putFileAs("news/", $request['file'], $filename);
            $model->file()->create([
                'name' => $filename,
                'path' => 'news/',
                'format' => $request['file']->getClientOriginalExtension(),
            ]);
        }
        $localization = $this->getLocalization($lang);
        
        $model->language()->create([
            'language_id' => $localization->id,
            'title' => $request['title'],
            'description'=> $request['description'],      
            'content' => $request['content']
        ]);


        return true;
    }

    /**
     * Update Feature item.
     *
     * @param int $id
     * @param array $request
     * @return bool
     */
    public function update(string $lang,  array $request , int $id)
    {
        $model = $this->model->find($id);
        $model->update([
            'slug' => $request['slug'],
            'position' => $request['position'],
            'status' => intval($request['status']),
        ]);
        $localization = $this->getLocalization($lang);
        if(isset($request['file'])){
            $filename = 'time-' . time() . '.' . $request['file']->getClientOriginalExtension();
            Storage::disk('public_html')->putFileAs("news/", $request['file'], $filename);
            $model->file()->updateOrCreate([
                'name' => $filename,
                'path' => 'news/',
                'format' => $request['file']->getClientOriginalExtension(),
            ]);
        }
        $language = $model->language()->where('language_id', $localization)->first();
        if($language){
            $language->title = $request['title'];
            $language->description = $request['description'];
            $language->content = $request['content'];
            $language->save();
        }else{
        
            $model->language()->create([
                'language_id' => $localization->id,
                'title' => $request['title'],
                'description'=> $request['description'],      
                'content' => $request['content']
            ]);
        }

        return true;
    }

    /**
     * Create localization item into db.
     *
     * @param int $id
     * @return boolean
     * @throws \Exception
     */
    public function delete($id)
    {
        $data = $this->model->find($id);
        $data->delete();
        return true;
    }

    /**
     * Create localization item into db.
     *
     * @param string $lang
     * @return Localization
     * @throws \Exception
     */
    protected function getLocalization(string $lang) {
        $localization = Localization::where('abbreviation',$lang)->first();
        if (!$localization) {
            throwException('Localization not exist.');
        }

        return $localization;
    }
}
