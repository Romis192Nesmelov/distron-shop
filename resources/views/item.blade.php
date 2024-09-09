@extends('layouts.main')

@section('content')
    <x-section>
        <x-row>
            <div class="col-lg-3 col-md-6 col-sm-12 wow animate__animated animate__slideInLeft" data-wow-offset="10">
                @include('blocks.item_image_block',['id' => 'item-image', 'addClass' => 'w-100'])
            </div>
            <div class="col-lg-9 col-md-6 col-sm-12 wow animate__animated animate__slideInRight" data-wow-offset="10">
                <h1 class="text-left">{{ getItemHead($item) }}</h1>
                @include('blocks.content_block',['text' => $item->description])
                @if (getItemProps($item))
                    <p>{!! getItemProps($item) !!}</p>
                @endif
                <div class="price fs-3 fw-bold text-left mt-3 mb-3">
                    @include('blocks.price_block',['price' => $item->price])
                </div>
                @if ($item->file)
                    <p class="mb-4">
                        <a href="{{ asset($item->file) }}" {{ $item->description_file ? 'title='.$item->description_file : '' }} target="_blank">{{ $item->description_file ? $item->description_file : pathinfo($item->file)['basename'] }}</a>
                    </p>
                @endif
                @include('blocks.button_block', [
                    'dataTarget' => 'add-to-basket-modal',
                    'primary' => true,
                    'icon' => 'icon-basket',
                    'buttonText' => trans('content.add_to_basket')
                ])
            </div>
        </x-row>
    </x-section>
    <x-modal id="add-to-basket-modal" head="{{ trans('content.add_to_basket') }}">
        <form id="add-to-basket" class="d-flex flex-column align-items-center" method="post" action="{{ route('add_to_basket') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            @include('blocks.item_image_block')
            <h1 class="mb-1">{{ getItemHead($item) }}</h1>
            <p class="text-center">{!! $item->description !!}</p>
            @if (getItemProps($item))
                <p class="text-center">{!! getItemProps($item) !!}</p>
            @endif
            <div class="fs-3 fw-bold text-center basket-price">
                @include('blocks.price_block',[
                    'price' => session()->has('basket') && isset(session()->get('basket')[$item->id]) ? (int)session()->get('basket')[$item->id]['value'] * $item->price : $item->price
                ])
            </div>
            @include('blocks.basket_counter_block', [
                'name' => 'value',
                'min' => 1,
                'value' => session()->has('basket') && isset(session()->get('basket')[$item->id]) ? session()->get('basket')[$item->id]['value'] : 1
            ])
            @include('blocks.button_block', [
                'addClass' => 'mt-4',
                'buttonType' => 'submit',
                'primary' => true,
                'icon' => 'icon-basket',
                'buttonText' => trans('content.add_to_basket')
            ])
        </form>
    </x-modal>
    <script>window.price = parseInt("{{ $item->price }}");</script>
@endsection
