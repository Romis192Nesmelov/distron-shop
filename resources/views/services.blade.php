@extends('layouts.main')

@section('content')
    <x-section wow_delay=".1" wow_direction="Left" data-scroll-destination="services" head="{{ $services->name }}">
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
        <div class="row mb-4">
            @for ($i=1;$i<=4;$i++)
                <div class="col-md-3 col-sm-4 wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($i + 1) * 0.2 }}s">
                    <a class="fancybox w-100" href="{{ asset('storage/images/services/photo'.$i.'_full.jpg') }}">
                        <img class="image w-100" src="{{ asset('storage/images/services/photo'.$i.'_preview.jpg') }}" />
                    </a>
                </div>
            @endfor
        </div>
        {!! $services->text !!}
    </x-section>
@endsection
