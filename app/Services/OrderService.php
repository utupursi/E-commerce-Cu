<?php

namespace App\Services;

use App\Models\Feature;
use App\Models\Localization;
use App\Models\News;
use App\Models\Order;
use App\Payment\TbcLoan;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\throwException;

class OrderService
{
    protected $model;

    protected $perPageArray = [8, 10, 20, 30, 50, 100];

    public function __construct(Order $model)
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
     * Get Feature by id.
     *
     * @param string $slug
     * @return News
     */
    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
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

        if ($request->fullname !== null) {
            $data = $data->where(DB::raw("CONCAT(first_name,' ',last_name)"), 'LIKE', '%' . $request['fullname'] . '%');
        }

        if ($request->bank !== null) {
            $data->whereHas('bank', function ($query) use ($request) {
                $query->where('title', 'like', "%{$request->bank}%");
            });
        }
        if ($request->payment_type !== null) {
            $data->whereHas('paymentType', function ($query) use ($request) {
                $query->where('title', 'like', "%{$request->payment_type}%");
            });
        }

        if ($request->total_price !== null) {
            $data = $data->where('orders.total_price', 'LIKE', '%' . $request['total_price'] . '%');
        }

        if ($request->status != null) {
            $data = $data->where('orders.status', $request->status);
        }

        // Check if perPage exist and validation by perPageArray [].
        $perPage = ($request->per_page != null && in_array($request->per_page, $this->perPageArray)) ? $request->per_page : 10;
        return $data->orderBy('orders.id', 'DESC')->paginate($perPage);
    }


    /**
     * Update Feature item.
     *
     * @param int $id
     * @param Request $request
     *
     * @return bool|Application|RedirectResponse|Redirector
     */
    public function update(string $lang,Request $request, int $id)
    {
        $model = $this->model->find($id);
        if ($model->tbcLoan) {
            $tbcLoan = new TbcLoan();

            if ($request['status'] === "2") {
                $status = $tbcLoan->cancel($model->tbcLoan->session_id);
                if ($status === 404) {
                    return redirect(route('orderEditView', [$lang,$model->id]))->with('danger', 'Active installment with sessionId not exists.');
                }
                if ($status === 401) {
                    return redirect(route('orderEditView', [$lang,$model->id]))->with('danger', 'Call Developer.');
                }
            }
            if ($request['status'] === "1") {
                $status = $tbcLoan->confirm($model->tbcLoan->session_id);
                if ($status === 404) {
                    return redirect(route('orderEditView', [$lang,$model->id]))->with('danger', 'Active installment with sessionId not exists.');
                }
                if ($status === 401) {
                    return redirect(route('orderEditView', [$lang,$model->id]))->with('danger', 'Call Developer.');
                }
            }
        }
        $model->update([
            'status' => $request['status'],
        ]);

        return true;
    }

    protected function getLocalization(string $lang)
    {
        $localization = Localization::where('abbreviation', $lang)->first();
        if (!$localization) {
            throwException('Localization not exist.');
        }

        return $localization;
    }
}
