@extends('layout')

@section('content')
    <h1>Продукты</h1>
    <table class="table">
        <tr>
            <th>id</th>
            <th>Наименование продукта</th>
            <th>Наименование поставщика</th>
            <th>Цена</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->vendor->name}}</td>
                <td class="table-col__price">
                    <editable
                            :init-value="{{$product->price}}"
                            :product-id="{{$product->id}}"
                    >
                        {{$product->price}}
                    </editable>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $products->links() }}
@endsection
