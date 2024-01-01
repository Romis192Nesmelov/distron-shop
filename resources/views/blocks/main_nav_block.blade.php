<nav id="{{ $mainId }}" class="navbar navbar-expand-lg">
    <div id="basket" data-bs-toggle="modal" data-bs-target="#basket-modal">
        <div class="cir {{ !session()->has('basket') ? 'd-none' : '' }}">{{ session()->has('basket') ? count(session()->get('basket')) : '' }}</div>
        <i class="icon-basket"></i>
    </div>
{{--    <a class="navbar-brand" href="#">Navbar</a>--}}
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-controls="{{ $collapseId }}" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-navicon"></i>
    </button>
    <div class="collapse navbar-collapse" id="{{ $collapseId }}">
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
</nav>
