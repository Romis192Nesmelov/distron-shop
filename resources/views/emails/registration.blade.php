@extends('layouts.mail')

@section('content')
    <h2>{{ trans('content.message_from').env('APP_NAME') }}</h2>
    <h1>{{ trans('auth.confirm_register_head') }}</h1>
    <p>{{ trans('auth.confirm_register_part1') }}</p>
    <p>{{ trans('auth.confirm_register_part2') }}<a href="{{ route('confirmation_register', ['slug' => $token]) }}" target="_blank">{{ route('confirmation_register', ['slug' => $token]) }}</a></p>
@endsection
