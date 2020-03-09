@extends('layout')

@section('content')
    <h1>Заказы</h1>

    <ul class="nav nav-tabs">
        <li class="@linkIsActive('orders-past')">
            <a href="{{route('orders-past')}}">Просроченные</a>
        </li>
        <li class="@linkIsActive('orders-current')">
            <a href="{{route('orders-current')}}">Текущие</a>
        </li>
        <li class="@linkIsActive('orders-new')">
            <a href="{{route('orders-new')}}">Новые</a>
        </li>
        <li class="@linkIsActive('orders-completed')">
            <a href="{{route('orders-completed')}}">Выполненные</a>
        </li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active">
            <table class="table">
                <tr>
                    <th>id</th>
                    <th>Наименование партнера</th>
                    <th>Стоимость заказа</th>
                    <th>Состав заказа</th>
                    <th>Статус заказа</th>
                </tr>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <a href="{{route('orders.edit',['id'=>$order->id])}}" target="_blank">{{$order->id}}</a>
                        </td>
                        <td>{{$order->partner->name}}</td>
                        <td>{{$order->getSum()}}</td>
                        <td>
                            <ul>
                                @foreach($order->orderProducts as $orderProduct)
                                    <li>
                                        {{$orderProduct->product->name}}
                                        ${{$orderProduct->price}}
                                        x {{$orderProduct->quantity}}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>@orderLabel($order->status)</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
