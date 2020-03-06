@extends('layout')

@section('content')
    <h1>Заказы</h1>
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
                <td><a href="{{route('orders.edit',['id'=>$order->id])}}" target="_blank">{{$order->id}}</a></td>
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
                <td>
                    @if($order->status === \App\Enums\OrderStatus::NEW)
                        <span class="label label-warning">{{\App\Enums\OrderStatus::getDescription($order->status)}}</span>
                    @elseif($order->status === \App\Enums\OrderStatus::SUCCESS)
                        <span class="label label-primary">{{\App\Enums\OrderStatus::getDescription($order->status)}}</span>
                    @elseif($order->status === \App\Enums\OrderStatus::FINISH)
                        <span class="label label-success">{{\App\Enums\OrderStatus::getDescription($order->status)}}</span>
                    @else
                        {{$order->status}}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{ $orders->links() }}
@endsection
