<?php
/**
 *  app/Services/UserService.php
 *
 * User: 
 * Date-Time: 15.12.20
 * Time: 14:03
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Services;

use App\Http\Request\Admin\UserRequest;
use App\Models\Localization;
use App\Models\User;
use App\Models\UserLanguage;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\throwException;

class UserService
{
    protected $model;

    protected $perPageArray = [10, 20, 30, 50, 100];

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get User by id.
     *
     * @param int $id
     * @return User
     */
    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get Users.
     *
     * @param string $lang
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function getAll(string $lang,$request)
    {
        $data = $this->model->query();

        $localizationID = Localization::getIdByName($lang);

        if ($request->id) {
            $data = $data->where('id',$request->id);
        }

        if ($request->first_name) {
            $data = $data->with('language')->whereHas('language', function ($query) use ($localizationID, $request) {
                $query->where('first_name','like',"%{$request->first_name}%")->where('language_id',$localizationID);
            });
        }

        if ($request->last_name) {
            $data = $data->with('language')->whereHas('language', function ($query) use ($localizationID, $request) {
                $query->where('last_name','like',"%{$request->last_name}%")->where('language_id',$localizationID);
            });
        }

        if ($request->email) {
            $data = $data->where('email', 'like', "%{$request->email}%");
        }


        if ($request->status != null) {
            $data = $data->where('status',$request->status);
        }

        if ($request->role) {
            $data = $data->with('roles')->whereHas('roles', function ($query) use ( $request) {
                $query->where('id',$request->role);
            });
        }


        // Check if perPage exist and validation by perPageArray [].
        $perPage = ($request->per_page != null && in_array($request->per_page,$this->perPageArray)) ? $request->per_page : 10;

        return $data->orderBy('id', 'DESC')->paginate($perPage);
    }


    /**
     * Create Feature item into db.
     *
     * @param string $lang
     * @param UserRequest $request
     * @return bool
     */
    public function store(string $lang, UserRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;

        $localizationID = Localization::getIdByName($lang);



        $this->model = new User([
            'name' => $request['first_name'] . ' ' . $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'status' => $request['status'],
            'phone' => $request['phone'],
            'id_number' => $request['id_number']
        ]);

        $this->model->save();

        $this->model->language()->create([
            'user_id' => $this->model->id,
            'language_id' => $localizationID,
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'address' => $request['address']
        ]);


        $model = $this->model;

        $model->profile()->create([
            'birthday' => Carbon::parse($request['birthday']),
            'phone_1' => $request['phone_1'],
            'phone_2' => $request['phone_2'],
        ]);

        $model->roles()->attach($request['role']);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $imagename = date('Ymhs') . $file->getClientOriginalName();
                $destination = base_path() . '/storage/app/public_html/user/' . $this->model->id;
                $request->file('images')[$key]->move($destination, $imagename);
                $model->files()->create([
                    'name' => $imagename,
                    'path' => 'user/' . $model->id,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return true;
    }

    /**
     * Update Feature item.
     *
     * @param string $lang
     * @param int $id
     * @return bool
     */
    public function update(string $lang,int $id, $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;

        $localizationID = Localization::getIdByName($lang);

        $data = $this->find($id);

        $data->update([
            'email' => $request['email'],
            'status' => $request['status'],
            'phone' => $request['phone'],
            'id_number' => $request['id_number']
        ]);

        if ($request['password'] != null) {
            $data->update([
                'password' => Hash::make($request['password']),
            ]);
        }

        $userLanguage = UserLanguage::where(['user_id' => $data->id, 'language_id' => $localizationID])->first();

        if ($userLanguage == null) {
            $data->language()->create([
                'user_id' => $this->model->id,
                'language_id' => $localizationID,
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'address' => $request['address']
            ]);
        } else {
            $userLanguage->first_name = $request['first_name'];
            $userLanguage->last_name = $request['last_name'];
            $userLanguage->address = $request['address'];
            $userLanguage->save();
        }

        if (isset($request['role'])) {
            // Role update
            $data->roles()->detach();
            $data->roles()->attach($request['role']);
        }

        if ($data->profile == null) {
            $data->profile()->create([
                'birthday' => Carbon::parse($request['birthday']),
                'phone_1' => $request['phone_1'],
                'phone_2' => $request['phone_2'],
            ]);
        } else {
            $data->profile()->update([
                'birthday' => Carbon::parse($request['birthday']),
                'phone_1' => $request['phone_1'],
                'phone_2' => $request['phone_2'],
            ]);
        }

        // Delete product file if deleted in request.
        if (count($data->files) > 0) {
            foreach ($data->files as $file) {
                if ($request['old_images'] == null) {
                    $file->delete();
                    continue;
                }
                if (!in_array($file->id,$request['old_images'])) {
                    if (Storage::exists('public_html/user/' . $data->id.'/'.$file->name)) {
                        Storage::delete('public_html/user/' . $data->id.'/'.$file->name);
                    }
                    $file->delete();

                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $imagename = date('Ymhs') . $file->getClientOriginalName();
                $destination = base_path() . '/storage/app/public_html/user/' . $data->id;
                $request->file('images')[$key]->move($destination, $imagename);
                $data->files()->create([
                    'name' => $imagename,
                    'path' => '/storage/app/public_html/user/' . $data->id,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return true;
    }

    /**
     * Delete User item into db.
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete($id)
    {
        $data = $this->find($id);
        if (count($data->language) > 0) {
            if(!$data->language()->delete()){
                throwException('User languages can not delete.');
            }
        }

        if (count($data->files) > 0) {
            if (Storage::exists('public_html/user/' . $data->id)) {
                Storage::deleteDirectory('public_html/user/' . $data->id);
            }
            $data->files()->delete();
        }

        if (!$data->delete()) {
            throwException('User  can not delete.');
        }

        return true;
    }
}
