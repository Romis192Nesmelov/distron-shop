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
    <x-section class="mb-5" head="{{ $content->head }}">
        {!! $content->text !!}
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
    @if ($scroll)
        <script>window.scrollAnchor = "{{ $scroll }}";</script>
    @endif
    @if (auth()->guest())
        <script>window.showLogin = parseInt("{{ request()->has('login') }}");</script>
    @endif
@endsection
