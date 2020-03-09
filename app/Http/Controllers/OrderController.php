<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Partner;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
     * @param $orders
     * @return View
     */
    protected function index(Collection $orders)
    {
        $orders->load('partner', 'orderProducts');
        $orderStatuses = OrderStatus::toSelectArray();

        return view('orders.index', compact('orders', 'orderStatuses'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function indexPast()
    {
        $orders = Order::orderBy('delivery_dt', 'desc')
            ->whereDate('delivery_dt', '>', Carbon::now())
            ->where('status', OrderStatus::SUCCESS)
            ->limit(50)
            ->get();

        return $this->index($orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function indexCurrent()
    {
        $orders = Order::orderBy('delivery_dt', 'asc')
            ->whereDate('delivery_dt', '>', Carbon::now()->subHours(24))
            ->where('status', OrderStatus::SUCCESS)
            ->get();

        return $this->index($orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function indexNew()
    {
        $orders = Order::orderBy('delivery_dt', 'asc')
            ->whereDate('delivery_dt', '>', Carbon::now())
            ->where('status', OrderStatus::NEW)
            ->limit(50)
            ->get();

        return $this->index($orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function indexCompleted()
    {
        $orders = Order::orderBy('delivery_dt', 'asc')
            ->whereDate('delivery_dt', Carbon::today())
            ->where('status', OrderStatus::FINISH)
            ->limit(50)
            ->get();

        return $this->index($orders);
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
