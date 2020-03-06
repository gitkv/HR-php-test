@extends('layout')

@section('content')
    <div class="jumbotron">
        <h1>Погода в городе {{$weather->city->name}}</h1>
        <p>Температура {{$weather->temp}}</p>
        <p>Ощущается как {{$weather->feels_like}}</p>
        <p>Скорость ветра {{$weather->wind_speed}}</p>
        <small>Данные получены: {{$weather->updated_at}}</small>
    </div>
@endsection
