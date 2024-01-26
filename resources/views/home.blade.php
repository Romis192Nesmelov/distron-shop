@extends('layouts.main')

@section('content')
    <x-section wow_delay=".1" data-scroll-destination="{{ str()->slug($content[0]->head) }}" head="{{ $content[0]->head }}">
        <x-row>
            <div class="col-12 col-lg-4">
                <img class="w-100" src="{{ asset($content[0]->image) }}" />
            </div>
            <div class="col-12 col-lg-8">
                {!! $content[0]->text !!}
            </div>
        </x-row>
    </x-section>
    <hr>
    <x-section class="icons wow animate__animated animate__fadeIn" data-scroll-destination="{{ $menu['advantages']['scroll'] }}" head="{{ $menu['advantages']['name'] }}">
        <x-row>
            @foreach($icons as $k => $icon)
                @include('blocks.icon_block',[
                    'col' => 3,
                    'delay' => $k,
                    'icon' => $icon
                ])
            @endforeach
        </x-row>
    </x-section>
    <x-section class="color color1" data-scroll-destination="catalogue" head="{{ trans('menu.catalogue') }}">
        <x-row class="catalogue row pb-4 pt-5">
            @foreach($catalogue as $k => $type)
                <div class="col-lg-{{ 12/$catalogue->count() }} col-sm-12 text-center wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.3 }}s">
                    <a href="{{ route('get_items',['slug' => $type->slug]) }}">
                        <img class="image w-75" src="{{ asset($type->image) }}" />
                        <h3 class="text-white text-center mt-3">{{ $type->name }}</h3>
                    </a>
                </div>
            @endforeach
        </x-row>
    </x-section>
    <x-section wow_delay=".1" wow_direction="Left" data-scroll-destination="services" head="{{ $services->name }}">
        <div class="row mb-4">
            @for ($i=1;$i<=4;$i++)
                <div class="col-md-3 col-sm-4 wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($i + 1) * 0.2 }}s">
                    <a class="fancybox w-100" href="{{ asset('images/services/photo'.$i.'_full.jpg') }}">
                        <img class="image w-100" src="{{ asset('images/services/photo'.$i.'_preview.jpg') }}" />
                    </a>
                </div>
            @endfor
        </div>
        {!! $services->text !!}
        <x-row class="d-flex justify-content-center pt-5">
            @foreach($services->items as $k => $item)
                @include('blocks.type_item_block',[
                    'col' => 4,
                    'addClass' => 'ms-lg-3 me-lg-3',
                    'showDescription' => true
                ])
            @endforeach
        </x-row>
    </x-section>
    <hr>
    <x-section wow_delay=".1" wow_direction="Right" data-scroll-destination="{{ str()->slug($content[1]->head) }}" head="{{ $content[1]->head }}">
        <x-row>
            @include('blocks.white_section_image_content_block',[
                'colImage' => 3,
                'image' => asset($content[1]->image),
                'text' => $content[1]->text
            ])
        </x-row>
    </x-section>
    <hr>
    <x-section class="white" wow_delay=".1" data-scroll-destination="{{ $menu['faq']['scroll'] }}" head="{{ $menu['faq']['name'] }}">
        <x-row>
            @include('blocks.faq_block')
        </x-row>
    </x-section>
    <hr>
    <x-section wow_delay=".1" wow_direction="Right" data-scroll-destination="{{ $menu['contacts']['scroll'] }}" head="{{ $menu['contacts']['name'] }}">
        <x-row>
            @include('blocks.contacts_block')
        </x-row>
    </x-section>
    @if ($scroll)
        <script>window.scrollAnchor = "{{ $scroll }}";</script>
    @endif
    <script>window.showLogin = parseInt("{{ request()->has('login') }}");</script>
@endsection
