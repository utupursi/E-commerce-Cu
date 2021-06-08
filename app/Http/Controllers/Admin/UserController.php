<?php
/**
 *  app/Http/Controllers/Admin/UserController.php
 *
 * User: 
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\ProductRequest;
use App\Http\Request\Admin\UserRequest;
use App\Models\Feature;
use App\Models\Role;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class UserController extends AdminController
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     * @param string $lang
     * @return Application|Factory|View|Response
     */
    public function index(string $locale, Request $request)
    {
        $request->validate([
            'id' => 'integer|nullable',
            'first_name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable',
            'email' => 'string|max:255|nullable',
            'phone' => 'string|max:255|nullable',
            'status' => 'boolean|nullable',
        ]);
        $rolesArray = ['' => 'All'];

        return view('admin.modules.user.index', [
            'users' => $this->service->getAll($locale,$request),
            'rolesArray' => $rolesArray+$this->getRolesArray()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.modules.user.create',[
            'rolesArray' => $this->getRolesArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $lang
     * @param ProductRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(string $locale, UserRequest $request)
    {
        if (!$this->service->store($locale,$request)) {
            return redirect(route('userCreateView',$locale))->with('danger', 'User does not create.');
        }

        return redirect(route('userIndex', $locale))->with('success', 'User create successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id)
    {
        return view('admin.modules.user.show', [
            'user' => $this->service->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function edit(string $locale, int $id)
    {
        $user = $this->service->find($id);

        return view('admin.modules.user.update',[
            'user' => $user,
            'rolesArray' => $this->getRolesArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest  $request
     * @param string $locale
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(string $locale, UserRequest $request, int $id)
    {
        if (!$this->service->update($locale,$id,$request)) {
            return redirect(route('userIndex',$locale))->with('danger', 'User does not update.');
        }

        return redirect(route('userIndex', $locale))->with('success', 'User update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $locale
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(string $locale, int $id)
    {
        if (!$this->service->delete($id)) {
            return redirect(route('userIndex', $locale))->with('danger', 'User does not delete.');
        }
        return redirect(route('userIndex', $locale))->with('success', 'User delete successfully.');
    }


    protected function getRolesArray() {
        $roles = Role::all();
        $rolesArray = [];
        if ($roles != null) {
            foreach ($roles as $role) {
                $rolesArray[$role->id] = $role->name;
            }
        }
        return $rolesArray;
    }
}
