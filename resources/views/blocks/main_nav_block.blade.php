<div id="top-block">
    <div class="row m-0" id="top-line">
        <div class="col-lg-6 col-md-6 d-none d-md-flex justify-content-between align-items-center">
            <div class="contacts wow animate__animated animate__fadeIn" data-wow-delay=".3s">
                <span>{!! view('blocks.phone_block',['phone' => $contacts[1]->contact])->render() !!}</span>
                <span>{!! view('blocks.email_block',['email' => $contacts[2]->contact])->render() !!}</span>
                <span><nobr>{{ str_replace('<br>',' ',$contacts[0]->contact) }}</nobr></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column flex-md-row justify-content-end align-items-center">
            <form method="GET" action="{{ route('search') }}" class="pt-1 pb-1 wow animate__animated animate__fadeIn" data-wow-delay=".3s">
                <input type="text" name="find" placeholder="{{ trans('content.search') }}" value="{{ request('find') }}">
                <i class="icon-search4"></i>
            </form>
            @if (auth()->guest())
                @include('blocks.button_block',[
                    'id' => 'main-button',
                    'primary' => true,
                    'addClass' => 'wow animate__animated animate__fadeIn',
                    'buttonText' => trans('auth.login_register')
                ])
            @else
                @include('blocks.button_block',[
                    'id' => 'main-button',
                    'primary' => true,
                    'addClass' => 'wow animate__animated animate__fadeIn',
                    'buttonText' => trans('auth.account')
                ])
            @endif
        </div>
    </div>
    <nav id="main-nav" class="navbar navbar-expand-lg">
    {{--    <a class="navbar-brand" href="#">Navbar</a>--}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav-bar" aria-controls="main-nav-bar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-navicon"></i>
        </button>
        <div class="collapse navbar-collapse wow animate__animated animate__fadeIn" id="main-nav-bar">
            <ul class="navbar-nav mr-auto">
                @include('blocks.nav-item_block', [
                    'name' => '<i class="icon-home2"></i>',
                    'scroll' => 'home'
                ])
                @foreach($menu as $menuItemKey => $menuItem)
                    @include('blocks.nav-item_block', $menuItem)
                @endforeach
    {{--            @include('blocks._nav-item_block', [--}}
    {{--                'name' => trans('menu.language').' <i class="icon-earth"></i>',--}}
    {{--                'dropdown' => [--}}
    {{--                    ['name' => trans('menu.ru'), 'href' => route('change_lang',['lang' => 'ru'])],--}}
    {{--                    ['name' => trans('menu.en'), 'href' => route('change_lang',['lang' => 'en'])],--}}
    {{--                ]--}}
    {{--            ])--}}
            </ul>
        </div>
        <div id="basket" class="wow animate__animated animate__fadeIn" data-bs-toggle="modal" data-bs-target="#basket-modal">
            <div class="cir {{ !session()->has('basket') ? 'd-none' : '' }}">{{ session()->has('basket') ? count(session()->get('basket')) : '' }}</div>
            <i class="icon-basket"></i>
        </div>
    </nav>
</div>
