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
                <form id="filters" method="get" action="{{ route('get_items',['slug' => $type->slug]) }}">
                    @if ($min_price != $max_price)
                        <input type="hidden" name="min_price" value="{{ $min_price_val }}"/>
                        <input type="hidden" name="max_price" value="{{ $max_price_val }}"/>
                        <h3 class="mb-2">{{ trans('content.price') }}</h3>
                        <div id="range-slider-price"></div>
                    @endif

                    @if ($type->id == 1)
                        @if ($min_voltage != $max_voltage_val)
                            <input type="hidden" name="min_voltage" value="{{ $min_voltage_val }}"/>
                            <input type="hidden" name="max_voltage" value="{{ $max_voltage_val }}"/>
                            <h3 class="mt-4 mb-2">{{ trans('content.voltage') }}</h3>
                            <div id="range-slider-voltage"></div>
                        @endif

                        @if ($min_capacity_val != $max_capacity_val)
                            <input type="hidden" name="min_capacity" value="{{ $min_capacity_val }}"/>
                            <input type="hidden" name="max_capacity" value="{{ $max_capacity_val }}"/>
                            <h3 class="mt-4 mb-2">{{ trans('content.capacity') }}</h3>
                            <div id="range-slider-capacity"></div>
                        @endif
                    @elseif ($type->id == 2)
                        <input type="hidden" name="min_plates" value="{{ $min_plates_val }}"/>
                        <input type="hidden" name="max_plates" value="{{ $max_plates_val }}"/>
                        <h3 class="mt-4 mb-2">{{ trans('content.plates') }}</h3>
                        <div id="range-slider-plates"></div>
                    @endif

                    <div class="w-100 mt-4 text-center">
                        @include('blocks.button_block', [
                            'addClass' => 'w-100',
                            'primary' => true,
                            'buttonType' => 'submit',
                            'icon' => 'icon-filter4',
                            'buttonText' => trans('content.filtered')
                        ])
                        <a href="{{ route('get_items',['slug' => $type->slug]) }}">
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
            <div class="col-lg-9 col-sm-12 row">
                @foreach($items as $k => $item)
                    @include('blocks.type_item_block',[
                        'col' => 3,
                        'showDescription' => false
                    ])
                @endforeach
            </div>
        </x-row>
    </x-section>
    <script>
        window.minPrice = parseInt("{{ $min_price }}");
        window.maxPrice = parseInt("{{ $max_price }}");
        window.minPriceVal = parseInt("{{ $min_price_val }}");
        window.maxPriceVal = parseInt("{{ $max_price_val }}");
    </script>
    @if ($type->id == 1)
        <script>
            window.minVoltage = parseInt("{{ $min_voltage }}");
            window.maxVoltage = parseInt("{{ $max_voltage }}");
            window.minVoltageVal = parseInt("{{ $min_voltage_val }}");
            window.maxVoltageVal = parseInt("{{ $max_voltage_val }}");

            window.minCapacity = parseInt("{{ $min_capacity }}");
            window.maxCapacity = parseInt("{{ $max_capacity }}");
            window.minCapacityVal = parseInt("{{ $min_capacity_val }}");
            window.maxCapacityVal = parseInt("{{ $max_capacity_val }}");
        </script>
    @elseif ($type->id == 2)
        <script>
            window.minPlates = parseInt("{{ $min_plates }}");
            window.maxPlates = parseInt("{{ $max_plates }}");
            window.minPlatesVal = parseInt("{{ $min_plates_val }}");
            window.maxPlatesVal = parseInt("{{ $max_plates_val }}");
        </script>
    @endif
@endsection
