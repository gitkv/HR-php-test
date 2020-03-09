<?php


namespace App\Observers;


use App\Enums\OrderStatus;
use App\Mail\OrderCompleted;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{

    public function updated(Order $order)
    {

        if ($order->isDirty('status') && $order->status == OrderStatus::FINISH) {

            Mail::send(new OrderCompleted($order));

        }

    }

}
