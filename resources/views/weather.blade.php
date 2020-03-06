@extends('layout')

@section('content')
    <div class="jumbotron">
        <h1>Погода в городе {{$weather->city->name}}</h1>
        <p>Температура <b>{{$weather->temp}}</b>&#8451;</p>
        <p>Ощущается как <b>{{$weather->feels_like}}</b>&#8451;</p>
        <p>Скорость ветра <b>{{$weather->wind_speed}}</b> м/с</p>
        <small>Данные получены: {{$weather->updated_at}}</small>
    </div>
@endsection
