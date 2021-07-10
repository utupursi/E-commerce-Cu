<?php

namespace App\Services;

use App\Mail\VerifyMail;
use App\Models\Dictionary;
use App\Models\Feature;
use App\Models\Localization;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\throwException;

class AuthService
{
    protected $model;

    protected $perPageArray = [10, 20, 30, 50, 100];

    public function __construct(User $model)
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
        return $this->model->where('id', $id)->firstOrFail();
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
    
        try {
            DB::beginTransaction();

            $model = $this->model->create([
                'name' => $request['first_name'] . ' ' . $request['last_name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'status'=>1
            ]);

            $localization = $this->getLocalization($lang);

            foreach (Localization::all() as $item) {
                $model->language()->create([
                    'language_id' => $item->id,
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                ]);
            }

            $token = Str::random(40);
            $model->roles()->attach('2');
            $model->tokens()->create([
                'token' => Hash::make($token),
                'validate_till' => Carbon::now()->addDays(1)
            ]);

            if (!Auth::attempt([
                'email' => $request['email'],
                'password' => $request['password']
            ])) {
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'auth' => [__('validation.wrong_email_or_password')],
                ]);
                throw $error;
            }
        } catch (\Exception $dbException) {

            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

    /**
     * Create localization item into db.
     *
     * @param string $lang
     * @return Localization
     * @throws \Exception
     */
    protected function getLocalization(string $lang)
    {
        $localization = Localization::where('abbreviation', $lang)->first();
        if (!$localization) {
            throw new Exception('Localization not exist.');
        }

        return $localization;
    }


}
