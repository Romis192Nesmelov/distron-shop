@extends('layouts.main')

@section('content')
{{--    <x-section wow_delay=".1" data-scroll-destination="{{ str()->slug($content[0]->head) }}" head="{{ $content[0]->head }}">--}}
{{--        <x-row>--}}
{{--            <div class="col-12 col-lg-4">--}}
{{--                <img class="w-100" src="{{ asset($content[0]->image) }}" />--}}
{{--            </div>--}}
{{--            <div class="col-12 col-lg-8">--}}
{{--                {!! $content[0]->text !!}--}}
{{--            </div>--}}
{{--            <div class="col-12">--}}
{{--                @include('blocks.button_block',[--}}
{{--                    'primary' => true,--}}
{{--                    'addClass' => 'pull-right wow animate__animated animate__fadeIn',--}}
{{--                    'dataTarget' => 'feedback-modal',--}}
{{--                    'buttonText' => trans('content.details')--}}
{{--                ])--}}
{{--            </div>--}}
{{--        </x-row>--}}
{{--    </x-section>--}}
{{--    <hr>--}}
    <x-section class="mb-5" head="{{ $content->head }}">
        {!! $content->text !!}
{{--                <h5 class="w-100 text-center">{{ trans('content.home_block_table_head') }}</h5>--}}
{{--                <table class="w-100 table table-striped">--}}
{{--                    <tr>--}}
{{--                        <th></th>--}}
{{--                        <th class="text-uppercase text-center">{{ trans('content.repair') }}</th>--}}
{{--                        <th class="text-uppercase text-center">{{ trans('content.buy_new') }}</th>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="text-uppercase"><strong>{{ trans('content.compare_battery1') }}</strong></td>--}}
{{--                        <td class="text-center">{{ trans('content.compare_price', ['val' => 30]) }}</td>--}}
{{--                        <td class="text-center">{{ trans('content.compare_price', ['val' => 95]) }}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="text-uppercase"><strong>{{ trans('content.compare_battery2') }}</strong></td>--}}
{{--                        <td class="text-center">{{ trans('content.compare_price', ['val' => 50]) }}</td>--}}
{{--                        <td class="text-center">{{ trans('content.compare_price', ['val' => 150]) }}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="text-uppercase"><strong>{{ trans('content.compare_battery3') }}</strong></td>--}}
{{--                        <td class="text-center">{{ trans('content.compare_price', ['val' => 60]) }}</td>--}}
{{--                        <td class="text-center">{{ trans('content.compare_price', ['val' => 220]) }}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="text-uppercase"><strong>{{ trans('content.warranty') }}</strong></td>--}}
{{--                        <td class="text-center">{{ trans('content.warranty_years', ['val' => 2]) }}</td>--}}
{{--                        <td class="text-center">{{ trans('content.warranty_years', ['val' => 2]) }}</td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
    </x-section>
{{--    <x-section class="icons wow animate__animated animate__fadeIn" data-scroll-destination="{{ $menu['advantages']['scroll'] }}" head="{{ $menu['advantages']['name'] }}">--}}
{{--        <x-row>--}}
{{--            @foreach($icons as $k => $icon)--}}
{{--                @include('blocks.icon_block',[--}}
{{--                    'col' => 3,--}}
{{--                    'delay' => $k,--}}
{{--                    'icon' => $icon--}}
{{--                ])--}}
{{--            @endforeach--}}
{{--        </x-row>--}}
{{--    </x-section>--}}
{{--    <x-section wow_delay=".1" wow_direction="Right" data-scroll-destination="{{ str()->slug($content[1]->head) }}" head="{{ $content[1]->head }}">--}}
{{--        <x-row>--}}
{{--            <div class="col-md-8 col-sm-6 col-xs-12">--}}
{{--                {!! $content[1]->text !!}--}}
{{--                <div class="w-100">--}}
{{--                    @include('blocks.button_block',[--}}
{{--                        'primary' => true,--}}
{{--                        'addClass' => 'mt-3 wow animate__animated animate__fadeIn',--}}
{{--                        'dataTarget' => 'feedback-modal',--}}
{{--                        'buttonText' => trans('content.details')--}}
{{--                    ])--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--                <img class="w-100" src="{{ asset($content[1]->image) }}" />--}}
{{--            </div>--}}
{{--        </x-row>--}}
{{--    </x-section>--}}
{{--    <x-section data-scroll-destination="catalogue" head="{{ trans('menu.catalogue') }}">--}}
{{--        <x-row class="catalogue row">--}}
{{--            @foreach($catalogue as $k => $type)--}}
{{--                <div class="col-lg-{{ 12/$catalogue->count() }} col-sm-12 text-center wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.3 }}s">--}}
{{--                    <a class="href-block" href="{{ route('get_items',['slug' => $type->slug]) }}">--}}
{{--                        <div class="image" img="{{ asset($type->image) }}"></div>--}}
{{--                        <h3 class="text-center mt-3">{{ $type->name }}</h3>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </x-row>--}}
{{--    </x-section>--}}
{{--    <hr>--}}
{{--    <x-section wow_delay=".1" wow_direction="Left" data-scroll-destination="services" head="{{ $services->name }}">--}}
{{--        <x-row class="d-flex justify-content-center">--}}
{{--            @foreach($services->items as $k => $item)--}}
{{--                @include('blocks.type_item_block',[--}}
{{--                    'col' => 4,--}}
{{--                    'addClass' => 'ms-lg-3 me-lg-3',--}}
{{--                    'showDescription' => true--}}
{{--                ])--}}
{{--            @endforeach--}}
{{--        </x-row>--}}
{{--        <div class="row mb-4">--}}
{{--            @for ($i=1;$i<=4;$i++)--}}
{{--                <div class="col-md-3 col-sm-4 wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($i + 1) * 0.2 }}s">--}}
{{--                    <a class="fancybox w-100" href="{{ asset('images/services/photo'.$i.'_full.jpg') }}">--}}
{{--                        <img class="image w-100" src="{{ asset('images/services/photo'.$i.'_preview.jpg') }}" />--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endfor--}}
{{--        </div>--}}
{{--        {!! $services->text !!}--}}
{{--    </x-section>--}}

{{--    <x-section class="color color1" wow_delay=".1" data-scroll-destination="{{ $menu['faq']['scroll'] }}" head="{{ $menu['faq']['name'] }}">--}}
{{--        <x-row class="pb-5">--}}
{{--            @include('blocks.faq_block')--}}
{{--        </x-row>--}}
{{--    </x-section>--}}
{{--    <x-section wow_delay=".1" wow_direction="Right" data-scroll-destination="{{ $menu['contacts']['scroll'] }}" head="{{ $menu['contacts']['name'] }}">--}}
{{--        <x-row>--}}
{{--            @include('blocks.contacts_block')--}}
{{--        </x-row>--}}
{{--    </x-section>--}}
    @if ($scroll)
        <script>window.scrollAnchor = "{{ $scroll }}";</script>
    @endif
    <script>window.showLogin = parseInt("{{ request()->has('login') }}");</script>
@endsection
