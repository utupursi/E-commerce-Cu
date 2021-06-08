<?php
/**
 *  app/Services/FeatureService.php
 *
 * User: 
 * Date-Time: 18.12.20
 * Time: 11:07
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Services;

use App\Models\Feature;
use App\Models\FeatureLanguage;
use App\Models\Localization;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use function PHPUnit\Framework\throwException;

class FeatureService
{
    protected $model;

    protected $perPageArray = [10, 20, 30, 50, 100];

    public function __construct(Feature $model)
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

        if ($request->type) {
            $data = $data->where('type',  $request->type);
        }

        if ($request->position) {
            $data = $data->where('position', 'like', "%{$request->position}%");
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



        $this->model = new Feature([
            'position' => $request['position'],
            'status' => $request['status'],
            'slug' => $request['slug'],
            'type' => $request['type']
        ]);

        $this->model->save();

        $this->model->language()->create([
            'feature_id' => $this->model->id,
            'language_id' => $localizationID,
            'title' => $request['title'],
        ]);

        return true;
    }

    /**
     * Update Feature item.
     *
     * @param string $lang
     * @param int $id
     * @param array $request
     * @return bool
     */
    public function update(string $lang,int $id, array $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;

        $data = $this->find($id);
        $data->update([
            'position' => $request['position'],
            'status' => $request['status'],
            'slug' => $request['slug'],
            'type' => $request['type']
        ]);

        $localizationID = Localization::getIdByName($lang);

        $featureLanguage = FeatureLanguage::where(['feature_id' => $data->id, 'language_id' => $localizationID])->first();

        if ($featureLanguage == null) {
            $data->language()->create([
                'feature_id' => $this->model->id,
                'language_id' => $localizationID,
                'title' => $request['title'],
            ]);
        } else {
            $featureLanguage->title = $request['title'];
            $featureLanguage->save();
        }

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
        $data = $this->find($id);
        if (count($data->language) > 0) {
            if(!$data->language()->delete()){
                throwException('Feature languages can not delete.');
            }
        }
        if (!$data->delete()) {
            throwException('Feature  can not delete.');
        }
        return true;
    }
}
