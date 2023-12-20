<!doctype html>
<html>
<head>
    <title>{{ $seo['title'] }}</title>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fancybox.min.js') }}"></script>

{{--    <script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/feedback.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/setbackground.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.maskedinput.js') }}"></script>
</head>

<body>
<div id="main" data-scroll-destination="home">
    <div id="main-collage">
        @include('blocks.main_nav_block', ['mainId' => 'main-nav', 'collapseId' => 'main-nav-bar'])
        <div id="main-logo">
            <img class="logo wow animate__animated animate__fadeIn" data-wow-delay=".2s" src="{{ asset('images/logo.svg') }}" />
            <h1 class="wow animate__animated animate__fadeIn" data-wow-delay=".3s">Новая жизнь Вашего аккумулятора</h1>
            @include('blocks.button_block',[
                'primary' => true,
                'addClass' => 'wow animate__animated animate__fadeIn',
                'addAttr' => ['data-wow-delay' => '.3s'],
                'dataTarget' => 'feedback-modal',
                'buttonText' => trans('content.leave_request')
            ])
        </div>
        <div class="wow animate__animated animate__fadeIn" data-wow-delay="0.5s" id="video" controls="controls" poster="{{ asset('images/distron.jpg') }}">
            <video controls="controls" poster="{{ asset('images/distron.jpg') }}">
                @foreach ($video as $item)
                    <source src="{{ asset($item) }}" type='video/{{ pathinfo($item)['extension'] }};'>
                @endforeach
            </video>
            <a href="{!! $settings['video'] !!}" target="_blank"><span>{{ trans('content.look_at') }}</span><img src="{{ asset('images/ru_tube.png') }}" /></a>
        </div>
    </div>
    @yield('content')
</div>

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 image">
                        <img src="{{ asset('images/distron_shim.png') }}" />
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
                    <form action="{{ route('feedback_short') }}" method="post">
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
@include('blocks.message_modal_block')
<x-modal id="feedback-modal" head="{{ trans('content.feedback') }}">
    <form class="form" method="post" action="{{ route('feedback') }}">
        @csrf
        @include('blocks.request_block')
        <div class="mt-3 d-flex justify-content-end">
            @include('blocks.button_block',[
                'addClass' => 'me-3',
                'primary' => true,
                'dataDismiss' => false,
                'buttonType' => 'submit',
                'buttonText' => trans('content.send'),
                'disabled' => true
            ])
            @include('blocks.button_block',[
                'primary' => false,
                'dataDismiss' => true,
                'buttonText' => trans('content.close')
            ])
        </div>
    </form>
</x-modal>

{{--@foreach ($metrics as $metric)--}}
{{--    {!! $metric->code !!}--}}
{{--@endforeach--}}

</body>
</html>
