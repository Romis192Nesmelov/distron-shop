@extends('layouts.main')

@section('content')
    <x-section wow_delay=".1" head="{{ $type->name }}">
        <x-row>
            {!! $type->text !!}
        </x-row>
    </x-section>
    <hr>
    <x-section>
        <x-row>
            @foreach($type->items as $k => $item)
                <div class="col-lg-3 col-md-6 col-sm-12 mb-5 d-flex flex-column justify-content-between wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.1 }}s">
                    <div>
                        <a class="fancybox" href="{{ asset($item->image) }}"><img class="w-100 mb-4" src="{{ asset($item->image) }}" /></a>
                        <h5 class="w-100 text-center">{{ $item->name }}</h5>
                        <p class="w-100 text-center lh-sm mb-1"><small>{{ $item->short_description }}</small></p>
                    </div>
                    <div class="text-center">
                        <p class="w-100 text-center fs-3">
                            <strong>@include('blocks.price_block',['price' => $item->price])</strong>
                        </p>
                        <a href="{{ route('get_items',['slug' => $type->slug, 'id' => $item->id]) }}">
                            @include('blocks.button_block', [
                                'primary' => true,
                                'icon' => 'icon-circle-right2',
                                'buttonText' => trans('content.details')
                            ])
                        </a>
                    </div>
                </div>
            @endforeach
        </x-row>
    </x-section>
@endsection
