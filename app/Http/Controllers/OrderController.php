<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Partner;
use App\Services\OrderService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    protected $service;

    /**
     * OrderController constructor.
     * @param OrderService $service
     */
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'asc')->with('partner', 'orderProducts')->paginate(config('app.paginate_size'));
        $orderStatuses = OrderStatus::toSelectArray();

        return view('orders.index', compact('orders', 'orderStatuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return View
     */
    public function edit(Order $order)
    {
        $order->load('orderProducts');
        $partners = Partner::all();
        $orderStatuses = OrderStatus::toSelectArray();

        return view('orders.edit', compact('order', 'partners', 'orderStatuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderUpdateRequest $request
     * @param Order $order
     * @return Response
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $this->service->update($order, $request->validated());

        return Redirect::route('orders.edit', ['id' => $order->id]);
    }
}
