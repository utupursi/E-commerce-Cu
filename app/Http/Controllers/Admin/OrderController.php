<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Request\Admin\NewsRequest;
use App\Models\Localization;
use App\Models\News;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends AdminController
{
    protected $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale, Request $request)
    {
        $request->validate([
            'id' => 'integer|nullable',
            'fullname' => 'string|max:255|nullable',
            'bank' => 'string|max:255|nullable',
            'payment_type' => 'string|max:255|nullable',
            'total_price' => 'numeric|nullable',
            'status' => 'numeric|nullable',
        ]);

        $localization = Localization::where('abbreviation', $locale)->first()->id;
        return view('admin.modules.order.index', ['orders' => $this->service->getAll($locale, $request), 'locale' => $locale, 'localization' => $localization]);
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\News $order
     * @return \Illuminate\Http\Response
     */
    public function show(string $locale, int $id)
    {
        $order = Order::where(['id' => $id])->first();
        return view('admin.modules.order.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $localization = Localization::where('abbreviation', $locale)->first()->id;
        return view('admin.modules.order.edit', ['order' => $this->service->find(intval($id)), 'locale' => $locale, 'localization' => $localization]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\News $news
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $locale, $id)
    {
        // sxvanairad ver avamushave validacia unique ze
        $request->validate([
            'status' => 'required|numeric|max:255',
        ]);
        $this->service->update($locale, $request, $id);

        return redirect()->route('orderIndex', compact('locale'))->with('success', 'Order updated successfully.');
    }

}
