@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_order') }}" method="post">
                @csrf
                @include('admin.blocks.hidden_id_block',['id' => $order->id])
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks.radio_button_block',[
                                'values' => $statuses,
                                'name' => 'status',
                                'activeValue' => isset($order) ? $order->status : 0
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('blocks.input_block', [
                                'label' => trans('admin.number'),
                                'name' => 'number',
                                'type' => 'text',
                                'max' => 6,
                                'placeholder' => trans('admin.number'),
                                'value' => $order->number
                            ])
                            <h4>{{ trans('admin.email') }}: @include('blocks.email_block',['email' => $order->user->email])</h4>
                            <h4>{{ trans('admin.phone').': '.($order->user->phone ? $order->user->phone : trans('admin.no')) }}</h4>
                            @if ($order->delivery)
                                <h4>{{ trans('admin.delivery_address',['address' => $order->user->address]) }}</h4>
                            @else
                                <h4>{{ trans('admin.pickup') }}</h4>
                            @endif
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <x-atitle>{{ trans('admin.items_order') }}</x-atitle>
                        <div class="panel-body">
                            <table class="table datatable-basic table-striped table-items">
                                <tr>
                                    <th class="text-center">{{ trans('mail.category') }}</th>
                                    <th class="text-center">{{ trans('mail.item_name') }}</th>
                                    <th class="text-center">{{ trans('mail.item_value') }}</th>
                                    <th class="text-center">{{ trans('mail.item_price') }} ₽</th>
                                </tr>
                                @php $total = 0; @endphp
                                @foreach ($order->items as $item)
                                    @php $total += $item->pivot->value * $item->price; @endphp
                                    <tr>
                                        <td class="text-center"><b>{{ $item->type->name }}</b></td>
                                        <td class="text-center">{{ $item->name }}</td>
                                        <td class="text-center">{{ $item->pivot->value }}</td>
                                        <td class="text-center"><b>@include('blocks.price_block',['price' => $item->pivot->value * $item->price])</b></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-left"><h3 class="text-left">{{ trans('mail.total_price') }}</h3></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right"><h3 class="text-right">@include('blocks.price_block',['price' => $total])</h3></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
    <script>window.dtRows = 1;</script>
@endsection
