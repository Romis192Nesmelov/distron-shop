<!doctype html>
<html>
<head>
    <title>{{ $seo['title'] ?? 'Distron-shop' }}</title>
    @foreach($metas as $meta => $params)
        @if ($seo[$meta])
            <meta {{ $params['name'] ? 'name='.$params['name'] : 'property='.$params['property'] }} content="{{ $seo[$meta] }}">
        @endif
    @endforeach
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">

    @include('blocks.favicon_block')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icons/icomoon/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icons/fontawesome/styles.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/range.sliders.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ion_rangeslider.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ajax_form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/setbackground.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.maskedinput.js') }}"></script>
</head>

<body>
<div id="main" data-scroll-destination="home">
    @include('blocks.main_nav_block')
    <div id="main-collage">
        <div id="main-logo">
            <img class="logo wow animate__animated animate__fadeIn" data-wow-delay=".2s" src="{{ asset('storage/images/logo.svg') }}" />
            <h1 class="wow animate__animated animate__fadeIn" data-wow-delay=".3s">{{ trans('content.tagline') }}</h1>
            @include('blocks.button_block',[
                'primary' => true,
                'addClass' => 'wow animate__animated animate__fadeIn',
                'dataTarget' => 'feedback-modal',
                'buttonText' => trans('content.leave_request')
            ])
        </div>
        <img id="main-image" src="{{ asset('storage/images/battery.png') }}" />
    </div>
    <x-section>
        <div id="breadcrumbs" class="ps-4 wow animate__animated animate__slideInLeft" data-wow-offset="10" data-wow-delay=".5s">
            <div><a href="{{ route('home') }}"><i class="icon-home2"></i>{{ trans('menu.home') }}</a></div>
            @foreach($breadcrumbs as $breadcrumb)
                <div><i class="icon-arrow-right14"></i><a href="{{ $breadcrumb['route'] }}">{{ $breadcrumb['name'] }}</a></div>
            @endforeach
        </div>
    </x-section>
    @yield('content')
</div>

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <img class="w-100" src="{{ asset('storage/images/distron_shim.png') }}" />
                    </div>
                    <div class="col-md-6 ml-auto">
                        <ul class="list-unstyled">
                            @foreach($menu as $menuItemKey => $menuItem)
                                @include('blocks.nav-item_block', $menuItem)
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ml-auto">
                <div class="mb-5">
                    <h2 class="footer-heading mb-4">{{ trans('content.feedback') }}</h2>
                    <form id="form-feedback-short" action="{{ route('feedback_short') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            @include('blocks.error_block',['name' => 'phone'])
                            <input class="form-control rounded-0 border-secondary text-white bg-transparent" placeholder="+7(___)___-__-__" name="phone">
                            <div class="input-group-append">
                                @include('blocks.button_block',[
                                    'primary' => true,
                                    'addClass' => 'text-white rounded-0',
                                    'dataDismiss' => false,
                                    'buttonType' => 'submit',
                                    'buttonText' => trans('content.feedback'),
                                    'disabled' => true
                                ])
                            </div>
                        </div>
                        @include('blocks.checkbox_block',[
                            'checked' => false,
                            'name' => 'i_agree',
                            'label' => trans('content.i_agree'),
                        ])
                    </form>
                </div>
            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <div class="pt-5">
                    <p class="small">Copyright ©{{ date('Y') }} Distron Technology</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="on-top-button" data-scroll="home"><i class="icon-arrow-up12"></i></div>
@if (auth()->guest())
    <x-modal id="login-modal" head="{{ trans('auth.login') }}">
        <form id="login-form" method="post" action="{{ route('auth.login') }}">
            @csrf
            @include('blocks.input_block',[
                'name' => 'email',
                'type' => 'email',
                'label' => trans('auth.email'),
                'placeholder' => trans('auth.email'),
                'ajax' => true,
            ])
            @include('blocks.input_block',[
                'name' => 'password',
                'type' => 'password',
                'label' => trans('auth.password'),
                'placeholder' => trans('auth.password'),
                'ajax' => true,
            ])
            @include('blocks.checkbox_block',[
                'checked' => false,
                'name' => 'remember',
                'label' => trans('auth.remember_me'),
            ])
            <div class="w-100 text-center mt-3">
                <a href="#" id="register-href">{{ trans('auth.register') }}</a>
            </div>
            <div class="w-100 text-center mt-1">
                <a href="#" id="forgot-password-href">{{ trans('auth.forgot_your_password') }}</a>
            </div>
            <div class="w-100 text-center mt-1">
                <a href="#" id="send-confirmation-mail-again">{{ trans('auth.send_confirmation_mail_again') }}</a>
            </div>
            @include('blocks.buttons_pair_block',[
                'submitDisabled' => false,
                'submitText' => trans('auth.enter')
            ])
        </form>
    </x-modal>
    <x-modal id="register-modal" head="{{ trans('auth.register_head') }}">
        <form id="register-form" method="post" action="{{ route('auth.register') }}">
            @csrf
            @include('blocks.input_block',[
                'name' => 'email',
                'type' => 'email',
                'label' => trans('auth.email'),
                'placeholder' => trans('auth.email'),
                'ajax' => true,
            ])
            @include('blocks.password_inputs_pair_block')
            @include('blocks.checkbox_block',[
                'checked' => false,
                'name' => 'i_agree',
                'label' => trans('content.i_agree'),
            ])
            @include('blocks.buttons_pair_block',[
                'submitDisabled' => true,
                'submitText' => trans('auth.register')
            ])
        </form>
    </x-modal>
    <x-modal id="reset-password-modal" head="{{ trans('auth.register_head') }}">
        <form id="reset-password-form" method="post" action="{{ route('auth.reset_password') }}">
            @csrf
            @include('blocks.input_block',[
                'name' => 'email',
                'type' => 'email',
                'label' => trans('auth.email'),
                'placeholder' => trans('auth.email'),
                'ajax' => true,
            ])
            @include('blocks.buttons_pair_block',[
                'submitDisabled' => false,
                'submitText' => trans('auth.reset_the_password')
            ])
        </form>
    </x-modal>
    <x-modal id="send-confirmation-mail-modal" head="{{ trans('auth.send_confirmation_mail_again') }}">
        <form id="send-confirmation-mail-form" method="post" action="{{ route('verification.send') }}">
            @csrf
            @include('blocks.input_block',[
                'name' => 'email',
                'type' => 'email',
                'placeholder' => trans('auth.enter_your_email'),
                'ajax' => true,
            ])
            <div class="mt-4 d-flex justify-content-center">
                @include('blocks.button_block',[
                    'disabled' => false,
                    'addClass' => 'me-3',
                    'primary' => true,
                    'dataDismiss' => false,
                    'buttonType' => 'submit',
                    'buttonText' => trans('auth.send_confirmation_mail_again'),
                ])
            </div>
        </form>
    </x-modal>
@endif

<x-modal id="account-modal" head="{{ trans('auth.account') }}">
    <form id="account-form" method="post" action="{{ route('edit_account') }}">
        @csrf
        @include('blocks.input_block',[
            'name' => 'email',
            'type' => 'email',
            'value' => auth()->check() ? auth()->user()->email : '',
            'label' => trans('auth.email'),
            'placeholder' => trans('auth.email'),
            'ajax' => true,
        ])
        @include('blocks.input_block',[
            'name' => 'phone',
            'type' => 'text',
            'value' => auth()->check() ? auth()->user()->phone : '',
            'label' => trans('auth.phone'),
            'placeholder' => '+7(___)___-__-__',
            'ajax' => true,
        ])
        @include('blocks.input_block',[
            'name' => 'address',
            'value' => auth()->check() ? auth()->user()->address : '',
            'type' => 'text',
            'label' => trans('auth.address'),
            'placeholder' => trans('auth.address'),
            'ajax' => true,
        ])
        <div class="border border-secondary rounded-3 p-3 mb-3">
            <p class="text-center">{{ trans('auth.keep_password') }}</p>
            @include('blocks.input_block',[
                'name' => 'old_password',
                'type' => 'password',
                'label' => trans('auth.old_password'),
                'ajax' => true
            ])
            @include('blocks.password_inputs_pair_block')
        </div>
        @include('blocks.checkbox_block',[
            'checked' => false,
            'name' => 'i_agree',
            'label' => trans('content.i_agree'),
        ])
        @include('blocks.buttons_pair_block',[
            'submitDisabled' => true,
            'submitText' => trans('auth.register')
        ])
    </form>
</x-modal>
<x-modal id="basket-modal" head="{{ trans('content.basket') }}">
    <h3 id="no-products" class="text-center {{ session()->has('basket') && count(session()->get('basket')) ? 'd-none' : '' }}">{{ trans('content.no_products_in_the_basket') }}</h3>
    <form id="checkout" class="{{ !session()->has('basket') ? 'd-none' : '' }}" method="post" action="{{ route('checkout') }}">
        @csrf
        <table id="basket-table" class="table table-striped">
            @if (session()->has('basket'))
                @foreach(session()->get('basket') as $id => $position)
                    @include('blocks.basket_item_block',[
                        'id' => $id,
                        'item' => $position['item'],
                        'value' => $position['value'],
                        'price' => $position['value'] * $position['item']->price
                    ])
                @endforeach
            @else
                @include('blocks.basket_item_block',[
                    'id' => 1,
                    'item' => null,
                    'value' => 1,
                    'price' => 1
                ])
            @endif
        </table>
        <hr>
        <div class="d-flex justify-content-between align-items-center pt-2">
            @include('blocks.button_block', [
                'id' => null,
                'buttonType' => 'submit',
                'primary' => true,
                'icon' => 'icon-checkmark4',
                'buttonText' => trans('content.checkout')
            ])
            <h3 id="basket-total" class="mb-0">{{ trans('content.total') }}<nobr><span>@include('blocks.price_block',['price' => $basketTotal])</span></nobr></h3>
        </div>
    </form>
</x-modal>
<x-modal id="new-order-modal" head="{{ trans('content.placing_an_order') }}">
    <form id="new-order" method="post" action="{{ route('new_order') }}">
        @csrf
        @include('blocks.input_block',[
            'name' => 'phone',
            'type' => 'text',
            'value' => auth()->check() ? auth()->user()->phone : '',
            'label' => trans('auth.phone'),
            'placeholder' => '+7(___)___-__-__',
            'ajax' => true,
        ])
        @include('blocks.radio_buttons_block',[
            'name' => 'delivery',
            'buttons' => [
                ['value' => 1, 'label' => trans('content.delivery')],
                ['value' => 0, 'label' => trans('content.pickup')]
            ],
            'checked' => 1
        ])
        <div class="delivery-block mt-1 mb-3">
            @include('blocks.input_block',[
                'name' => 'address',
                'value' => auth()->check() ? auth()->user()->address : '',
                'type' => 'text',
                'label' => trans('auth.address'),
                'placeholder' => trans('auth.address'),
                'ajax' => true,
            ])
        </div>
        <div class="delivery-block mt-3 mb-3 d-none">
            {{ $pickup_address }}
        </div>
        @include('blocks.textarea_block',[
            'name' => 'notes',
            'label' => trans('content.notes'),
            'max' => 3000,
            'simple' => true
        ])
        @include('blocks.button_block', [
            'id' => null,
            'buttonType' => 'submit',
            'primary' => true,
            'icon' => 'icon-list-unordered',
            'buttonText' => trans('content.checkout')
        ])
    </form>
</x-modal>
@include('blocks.message_modal_block')

<x-modal id="feedback-modal" head="{{ trans('content.feedback') }}">
    <form id="form-feedback-full" class="form" method="post" action="{{ route('feedback') }}">
        @csrf
        @include('blocks.request_block')
        <div class="mt-3 d-flex justify-content-end">
            @include('blocks.button_block',[
                'id' => null,
                'addClass' => 'me-3',
                'primary' => true,
                'dataDismiss' => false,
                'buttonType' => 'submit',
                'buttonText' => trans('content.send'),
                'disabled' => true
            ])
            @include('blocks.button_block',[
                'id' => null,
                'primary' => true,
                'addClass' => 'wow animate__animated animate__fadeIn',
                'dataTarget' => 'request-modal',
                'buttonText' => trans('content.leave_request')
            ])
        </div>
    </form>
</x-modal>

@foreach ($metrics as $metric)
    {!! $metric->code !!}
@endforeach

@if (session()->has('message'))
    <script>window.showMessage = true;</script>
@endif

<script>
    window.accountText = "{{ trans('auth.account') }}";
    window.guest = parseInt("{{ (int)auth()->guest() }}");
    window.getNewCsrfUrl = "{{ route('get_new_csrf') }}";
    window.accountUrl = "{{ route('account') }}";
    window.changeBasketUrl = "{{ route('change_basket') }}";
</script>

</body>
</html>
