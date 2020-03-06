@extends('layout')

@section('content')
    <h1>Редактирование заказа id {{$order->id}}</h1>

    <form method="post" action="{{route('orders.update',['id'=>$order->id])}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form-group">
            <label for="exampleInputEmail1">Email клиента</label>
            <input required type="email" name="client_email" class="form-control" value="{{$order->client_email}}"
                   placeholder="Email">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Партнер</label>
            <select required name="partner_id" class="form-control">
                @foreach($partners as $partner)
                    <option value="{{$partner->id}}" @if($partner->id === $order->partner_id) selected @endif>
                        {{$partner->id}} | {{$partner->name}} ({{$partner->email}})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <table class="table">
                <tr>
                    <th>Наименование продукта</th>
                    <th>Количество</th>
                </tr>
                @foreach($order->orderProducts as $orderProduct)
                    <tr>
                        <td>{{$orderProduct->product->name}}</td>
                        <td>{{$orderProduct->quantity}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Статус заказа</label>
            <select name="status" class="form-control">
                @foreach($orderStatuses as $statusId => $statusName)
                    <option value="{{$statusId}}" @if($order->status === $statusId) selected @endif>
                        {{$statusName}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            Сумма заказа: {{$order->getSum()}}
        </div>

        <button type="submit" class="btn btn-default">Сохранить</button>
    </form>
@endsection
