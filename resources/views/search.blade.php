@extends('layouts.main')

@section('content')
    <x-section class="search-result" wow_delay=".1" head="{{ trans('content.search_result',['string' => request('find')]) }}">
        @if (!count($found))
            <h4 class="w-100 text-center mb-5">{{ trans('content.found_nothing') }}</h4>
        @else
            @foreach ($found as $k => $item)
                <x-row class="wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.2 }}s">
                    <div class="col-lg-2 col-md-6 col-sm-12 mb-4">
                        <a class="href-block" href="{{ $item['href'] }}">
                            <div class="image w-100" img="{{ asset($item['image']) }}"></div>
                        </a>
                    </div>
                    <div class="col-lg-10 col-md-6 col-sm-12 mb-4 d-flex flex-column justify-content-between">
                        <div>
                            <a class="href-block" href="{{ $item['href'] }}">
                                <h3>{!! $item['head'] !!}</h3>
                                <p>{!! $item['description'] !!}</p>
                            </a>
                        </div>
                        <a class="href-block" href="{{ $item['href'] }}">
                            @include('blocks.button_block', [
                                'primary' => true,
                                'icon' => 'icon-circle-right2',
                                'buttonText' => trans('content.details')
                            ])
                        </a>
                    </div>
                </x-row>
            @endforeach
            <div class="paginator">{{ $found->withQueryString()->links() }}</div>
        @endif
    </x-section>
@endsection
