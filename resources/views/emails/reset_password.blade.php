@extends('layouts.mail')

@section('content')
    <h2>{{ trans('content.message_from').env('APP_NAME') }}</h2>
    <h1>{{ trans('auth.reset_password') }}</h1>
    <p>{{ trans('auth.reset_password_message') }}</p>
    <p>{{ trans('auth.reset_password_ignore_message') }}</p>
    <h3>{{ trans('auth.your_new_password') }}<b>{{ $newPassword }}</b></h3>
@endsection
