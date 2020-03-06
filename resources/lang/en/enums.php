<?php

use App\Enums\OrderStatus;

return [

    OrderStatus::class => [
        OrderStatus::NEW     => 'New',
        OrderStatus::SUCCESS => 'Success',
        OrderStatus::FINISH  => 'Finish',
    ],

];