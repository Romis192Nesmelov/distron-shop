@extends('layouts.main')

@section('content')
    <x-section>
        <x-row>
            <div class="col-lg-4 col-md-6 col-sm-12 wow animate__animated animate__slideInLeft" data-wow-offset="10">
                <a class="fancybox" href="{{ asset($item->image) }}"><img id="item-image" class="w-100 mb-4" src="{{ asset($item->image) }}" /></a>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 wow animate__animated animate__slideInRight" data-wow-offset="10">
                <h2 class="text-left">{{ $item->name }}</h2>
                {!! $item->long_description !!}
                <h1 class="price text-left mt-3 mb-3">
                    @include('blocks.price_block',['price' => $item->price])
                </h1>
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
            <img class="w-50" src="{{ asset($item->image) }}" />
            <h3 class="mt-4 mb-1">{{ $item->name }}</h3>
            <p class="text-center">{{ $item->short_description }}</p>
            <h1 class="text-center basket-price">
                @include('blocks.price_block',[
                    'price' => session()->has('basket') && isset(session()->get('basket')[$item->id]) ? (int)session()->get('basket')[$item->id]['value'] * $item->price : $item->price
                ])
            </h1>
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
