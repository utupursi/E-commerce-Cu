<?php
/**
 *  app/Services/LocalizationService.php
 *
 * User: 
 * Date-Time: 18.12.20
 * Time: 11:07
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Services;

use App\Http\Request\Admin\LocalizationRequest;
use App\Models\Localization;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LocalizationService
{
    protected $model;

    protected $perPageArray = [10, 20, 30, 50, 100];

    public function __construct(Localization $model)
    {
        $this->model = $model;
    }

    /**
     * Get Localization by id.
     *
     * @param int $id
     * @return Localization
     */
    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get localizations.
     *
     * @param LocalizationRequest $request
     * @return LengthAwarePaginator
     */
    public function getAll($request)
    {
        $data = $this->model->query();

        if ($request->id) {
            $data = $data->where('id',$request->id);
        }

        if ($request->title) {
            $data = $data->where('title', 'like', "%{$request->title}%");
        }

        if ($request->abbreviation) {
            $data = $data->where('abbreviation', 'like', "%{$request->abbreviation}%");
        }

        if ($request->native) {
            $data = $data->where('native', 'like', "%{$request->native}%");
        }

        if ($request->localization) {
            $data = $data->where('locale', 'like', "%{$request->localization}%");
        }
        if ($request->status != null) {
            $data = $data->where('status',$request->status);
        }


        // Check if perPage exist and validation by perPageArray [].
        $perPage = ($request->per_page != null && in_array($request->per_page,$this->perPageArray)) ? $request->per_page : 10;
        return $data->paginate($perPage);
    }


    /**
     * Create localization item into db.
     *
     * @param array $request
     * @return LengthAwarePaginator
     */
    public function store(array $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;
        $request['default'] = isset($request['default']) ? 1 : 0;

        return $this->model->create($request);
    }

    /**
     * Update localization item.
     *
     * @param int $id
     * @param array $request
     * @return bool
     */
    public function update($id, array $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;
        $request['default'] = isset($request['default']) ? 1 : 0;
        if ($request['default']) {
            $this->updateDefault();
        }
        $data = $this->find($id);
        return $data->update($request);
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
        if ($data->default) {
            return false;
        }
        return $data->delete();
    }


    protected function updateDefault() {
        $localization = Localization::where('default', true)->first();
        if ($localization != null) {
            $localization->default = false;
            $localization->save();
        }

        return true;
    }
}
