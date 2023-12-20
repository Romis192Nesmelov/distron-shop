@extends('layouts.main')

@section('content')
    <x-section wow_delay=".1" data-scroll-destination="{{ str()->slug($content[0]->head) }}" head="{{ $content[0]->head }}">
        <x-row>
            <div class="col-12 col-lg-4 image">
                <img src="{{ asset($content[0]->images[0]->preview) }}" />
            </div>
            <div class="col-12 col-lg-8">
                {!! $content[0]->text !!}
            </div>
        </x-row>
    </x-section>
    <hr>
    <x-section class="icons" wow_delay=".1" data-scroll-destination="{{ $menu['advantages']['scroll'] }}" head="{{ $menu['advantages']['name'] }}">
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
    <x-section class="color color1" wow_delay=".1" data-scroll-destination="catalogue" head="{{ trans('menu.catalogue') }}">
        <x-row class="pb-4 pt-4 d-flex justify-content-center">

        </x-row>
    </x-section>
    <x-section wow_delay=".1" data-scroll-destination="{{ str()->slug($content[1]->head) }}" head="{{ $content[1]->head }}">
        <x-row>
            @include('blocks.white_section_image_content_block',[
                'colImage' => 3,
                'image' => asset($content[1]->images[0]->preview),
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
    <x-section wow_delay=".1" data-scroll-destination="{{ $menu['contacts']['scroll'] }}" head="{{ $menu['contacts']['name'] }}">
        <x-row>
            @include('blocks.contacts_block')
        </x-row>
    </x-section>
    @if ($scroll)
        <script>window.scrollAnchor = "{{ $scroll }}";</script>
    @endif
@endsection
