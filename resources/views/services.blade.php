@extends('layouts.main')

@section('content')
    <x-section class="pb-5" wow_delay=".1" wow_direction="Left" data-scroll-destination="services" head="{{ $services->name }}">
        <x-row class="d-flex justify-content-center">
            @foreach($services->items as $k => $item)
                @include('blocks.type_item_block',[
                    'href' => 'services',
                    'col' => 4,
                    'addClass' => 'ms-lg-3 me-lg-3',
                    'showDescription' => true
                ])
            @endforeach
        </x-row>
        {!! $services->text !!}
    </x-section>
@endsection
