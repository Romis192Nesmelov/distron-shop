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
        <h2 class="w-100 fs-3 mb-5 text-center wow animate__animated animate__fadeIn" data-wow-delay=".3s">{{ trans('content.advantages') }}</h2>
        <x-row>
            @foreach($icons as $k => $icon)
                @include('blocks.icon_block',[
                    'col' => 3,
                    'delay' => $k,
                    'icon' => $icon
                ])
            @endforeach
        </x-row>
        <hr class="mt-5 mb-5">
        {!! $content->text !!}
    </x-section>

    @if (count($diplomas))
        <hr class="mt-3 mb-3">
        <x-section class="mb-5" head="{{ trans('content.events') }}">
            <div class="row d-flex justify-content-center">
                @foreach($diplomas as $k => $diploma)
                    @include('blocks.diploma_block',[
                        'col' => 2,
                        'delay' => $k,
                        'diploma' => $diploma
                    ])
                @endforeach
            </div>
        </x-section>
    @endif

    <hr class="mt-3 mb-3">
    <x-section class="mb-5" head="{{ trans('content.faq') }}">
        <x-row>
            @include('blocks.faq_block')
        </x-row>
    </x-section>
    @if ($scroll)
        <script>window.scrollAnchor = "{{ $scroll }}";</script>
    @endif
    @if (auth()->guest())
        <script>window.showLogin = parseInt("{{ request()->has('login') }}");</script>
    @endif
@endsection
