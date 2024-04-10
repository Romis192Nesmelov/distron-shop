@extends('layouts.main')

@section('content')
    <x-section wow_delay=".1" head="{{ $type->name }}">
        <x-row>
            {!! $type->text !!}
        </x-row>
    </x-section>
    <hr>
    <x-section>
        <x-row>
            <div class="col-lg-3 col-sm-12 pe-lg-4 pe-sm-0">
                <form id="filters" method="get" action="{{ route('items',['slug' => $type->slug]) }}">
                    @foreach ($filters as $name => $params)
                        @if ($params['min'] != $params['max'])
                            @include('blocks.filter_slider_block',[
                                'mt' => !$loop->first,
                                'name' => $name,
                                'minVal' => $params['min_val'],
                                'maxVal' => $params['max_val']
                            ])
                        @endif
                    @endforeach
                    <div class="w-100 mt-4 text-center">
                        @include('blocks.button_block', [
                            'addClass' => 'w-100',
                            'primary' => true,
                            'buttonType' => 'submit',
                            'icon' => 'icon-filter4',
                            'buttonText' => trans('content.filtered')
                        ])
                        <a href="{{ route('items',['slug' => $type->slug]) }}">
                            @include('blocks.button_block', [
                                'addClass' => 'w-100 mt-2',
                                'primary' => true,
                                'icon' => 'icon-reset',
                                'buttonText' => trans('content.reset_filter')
                            ])
                        </a>
                    </div>
                </form>
            </div>
            <div class="items items-type-{{ $type->id }} col-lg-9 col-sm-12 row">
                @foreach($items as $k => $item)
                    @include('blocks.type_item_block',[
                        'href' => 'items',
                        'col' => 3,
                        'showDescription' => false
                    ])
                @endforeach
            </div>
        </x-row>
        <div class="paginator">{{ $items->withQueryString()->links() }}</div>
    </x-section>
    <script>window.filters = {!! json_encode($filters) !!};</script>
@endsection
