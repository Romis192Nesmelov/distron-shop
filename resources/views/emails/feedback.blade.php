@extends('layouts.mail')

@section('content')
    <h2>{{ trans('mail.request_from_the_site').' '.env('APP_NAME') }}</h2>
    <h3>{{ trans('mail.user_name',['name' => $name]) }}</h3>
    <h3>E-mail: {{ $email }}</h3>
    <h3>{{ trans('mail.phone',['phone' => $phone]) }}</h3>
@endsection
