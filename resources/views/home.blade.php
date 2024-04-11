@extends('layouts.main')

@section('content')
    @if (auth()->guest() && $token)
        <x-modal id="set-new-password-modal" head="{{ trans('auth.reset_password') }}">
            <form id="set-new-password-form" method="post" action="{{ route('auth.set_new_password') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                @include('blocks.input_block',[
                    'name' => 'email',
                    'type' => 'email',
                    'label' => trans('auth.email'),
                    'placeholder' => trans('auth.email'),
                    'ajax' => true,
                ])
                @include('blocks.password_inputs_pair_block')
                @include('blocks.buttons_pair_block',[
                    'submitDisabled' => false,
                    'submitText' => trans('auth.set_password')
                ])
            </form>
        </x-modal>
    @endif

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

{{--    <x-section class="color color1" wow_delay=".1" data-scroll-destination="{{ $menu['faq']['scroll'] }}" head="{{ $menu['faq']['name'] }}">--}}
{{--        <x-row class="pb-5">--}}
{{--            @include('blocks.faq_block')--}}
{{--        </x-row>--}}
{{--    </x-section>--}}
    @if ($scroll)
        <script>window.scrollAnchor = "{{ $scroll }}";</script>
    @endif
    @if (auth()->guest())
        <script>window.showLogin = parseInt("{{ request()->has('login') }}");</script>
    @endif
@endsection
