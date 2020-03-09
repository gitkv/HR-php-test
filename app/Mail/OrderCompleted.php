<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCompleted extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->order->load('orderProducts', 'partner', 'products');
        $this->to($this->getEmailAddresses());

        return $this->view('emails.order-complete')->with(['order' => $this->order]);
    }

    /**
     * @return array
     */
    protected function getEmailAddresses()
    {
        $emails = array_merge(
            [data_get($this->order->partner, 'email')],
            $this->order->products->load('vendor')->pluck('vendor.email')->toArray()
        );

        return $emails;
    }
}
