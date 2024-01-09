@extends('layouts.mail')

@section('content')
    <h1>{{ trans('mail.new_order_on_the_site').' '.env('APP_NAME') }}</h1>
    <h2>{{ trans('mail.order_number',['number' => $order->number]) }}</h2>
    <h4>E-mail: {{ $email }}</h4>
    @if ($order->delivery)
        <h3>{{ trans('mail.delivery_address') }}</h3>
        <p>{{ $address }}</p>
    @else
        <h3>{{ trans('mail.pickup') }}</h3>
        <p>{{ $pickup_address }}</p>
    @endif
    <h3>{{ trans('mail.notes') }}:</h3>
    <p>{{ $order->notes }}</p>
    <h3>{{ trans('mail.order_list') }}</h3>
    <table border="0" width="100%">
        <tr>
            <th>{{ trans('mail.category') }}</th>
            <th>{{ trans('mail.item_name') }}</th>
            <th>{{ trans('mail.item_value') }}</th>
            <th>{{ trans('mail.item_price') }} ₽</th>
        </tr>
        @foreach ($order->items as $item)
            <tr>
                <td align="center"><b>{{ $item->type->name }}</b></td>
                <td align="center">{{ $item->name }}</td>
                <td align="center">{{ $item->pivot->value }}</td>
                <td align="center"><b>{{ $item->pivot->value * $item->price }} ₽</b></td>
            </tr>
        @endforeach
    </table>
    <hr>
    <table border="0" width="100%">
        <tr>
            <td><h3 style="width: 100%; text-align: left;">{{ trans('mail.total_price') }}</h3></td>
            <td><h3 style="width: 100%; text-align: right;">{{ $total }} ₽</h3></td>
        </tr>
    </table>
@endsection
