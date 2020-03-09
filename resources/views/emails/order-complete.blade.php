<h1>
    Заказ №{{$order->id}} завершен.
</h1>

<p>
    Cостав заказа:
</p>
<table>
    <tr>
        <th>Наименование продукта</th>
        <th>Количество</th>
        <th>Цена</th>
    </tr>
    @foreach($order->orderProducts as $orderProduct)
        <tr>
            <td>{{$orderProduct->product->name}}</td>
            <td>{{$orderProduct->quantity}}</td>
            <td>{{$orderProduct->price}}</td>
        </tr>
    @endforeach
</table>

<p>
    Стоимость заказа {{$order->getSum()}}
</p>