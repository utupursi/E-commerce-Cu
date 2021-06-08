<?php

namespace App\Services;

use App\Http\Request\Admin\FeatureRequest;
use App\Models\Dictionary;
use App\Models\DictionaryLanguage;
use App\Models\Feature;
use App\Models\Localization;
use http\Client\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use function PHPUnit\Framework\throwException;

class DictionaryService
{
    protected $model;

    protected $perPageArray = [10, 20, 30, 50, 100];

    public function __construct(Dictionary $model)
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
        
        if ($request->key !== null) {
            $data = $data->where('key', 'LIKE', '%'.$request->all()['key'].'%');
        }
        if ($request->module !== null) {
            $data = $data->where('module', 'LIKE', '%'.$request->all()['module'].'%');
        }
        if ($request->language !== null) {
            $languagearray = DictionaryLanguage::where('value', 'LIKE', '%'.$request->all()['language'].'%')->get()->toArray();
            $data = $data->whereIn('id', $languagearray);
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
            'key' => $request['key'],
            'module' => $request['module'],
        ]);
        foreach (Localization::all() as $key => $lang) {
       
            $model->language()->create([
                'language_id' => $lang->id,
                'value' => $request['translates'][$key] ?? ''
            ]);
            
        }
        return true;
    }

    /**
     * Update Feature item.
     *
     * @param int $id
     * @param array $request
     * @return bool
     */
    public function update(int $id, array $request)
    {
        $model = $this->model->find($id);
        $model->update([
            'module' => $request['module'],
        ]);
        foreach (Localization::all() as $key => $lang) {
        
            $language = $model->language()->where('language_id', $lang->id)->first();
            
            if($language){
                $language->value = $request['translates'][$key] ?? '';
                $language->save();
            }else{
                $model->language()->create([
                    'language_id' => $lang->id,
                    'value' => $request['translates'][$key] ?? ''
                ]);
            }
                
            
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
        if(!$data->language()->delete()){
            throwException('Feature languages can not delete.');
        }
        if (!$data->delete()) {
            throwException('Feature  can not delete.');
        }
        return true;
    }

    /**
     * Create localization item into db.
     *
     * @param string $lang
     * @return Localization
     * 
     */
    protected function getLocalization(string $lang) {
        $localization = Localization::where('abbreviation',$lang)->first();
        if (!$localization) {
            throwException('Localization not exist.'); 
        }

        return $localization;
    }
}
