<?php


namespace App\Services;


use App\Models\Order;

class OrderService
{

    public function update(Order $order, array $data)
    {
        $order->fill($data);
        $order->save();

        return $order;
    }

}