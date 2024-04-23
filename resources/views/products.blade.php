@extends('layouts.main')

@section('content')
    <x-section data-scroll-destination="catalogue" head="{{ trans('menu.products') }}">
        <x-row class="catalogue row">
            @foreach($products as $k => $product)
                <div class="col-lg-{{ 12/count($products) }} col-sm-12 text-center wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.3 }}s">
                    <a class="href-block" href="{{ route('items',['slug' => $product->slug]) }}">
                        <div class="image" img="{{ asset($product->image) }}"></div>
                        <h2 class="text-center mt-3">{{ $product->name }}</h2>
                    </a>
                </div>
            @endforeach
        </x-row>
    </x-section>
@endsection
