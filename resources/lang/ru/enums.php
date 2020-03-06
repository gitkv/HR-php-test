<?php

use App\Enums\OrderStatus;

return [

    OrderStatus::class => [
        OrderStatus::NEW     => 'Новый',
        OrderStatus::SUCCESS => 'Подтвержден',
        OrderStatus::FINISH  => 'Завершен',
    ],

];