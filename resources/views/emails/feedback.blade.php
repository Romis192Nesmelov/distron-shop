@extends('layouts.mail')

@section('content')
    <h2>Заявка с сайта {{ env('APP_NAME') }}</h2>
    <h3>Имя пользователя: {{ $phone }}</h3>
    <h3>E-mail: {{ $phone }}</h3>
    <h3>Телефон: {{ $phone }}</h3>
@endsection
