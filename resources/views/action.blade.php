@extends('layouts.main')

@section('content')
    <x-section wow_delay=".1" head="{{ $action->name }}">
        @if ($action)
            <img class="w-100 border mb-5" {!! $action->alt_img ? 'alt="'.$action->alt_img.'"' : '' !!} src="{{ asset($action->image) }}" />
            {!! $action->text !!}
        @endif
    </x-section>
    @if ($actions->count())
        <hr>
        <x-section wow_delay=".1" head="{{ trans('content.actions_archive') }}">
            <x-row>
                @foreach($actions as $k => $action)
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-4 d-flex flex-column justify-content-between wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.2 }}s">
                        <div class="mb-3">
                            <a class="href-block" href="{{ route('actions',['id' => $action->id]) }}">
                                <img class="w-100 border mb-3" src="{{ asset($action->image) }}" />
                                <h4 class="w-100 text-center">{{ $action->name }}</h4>
                            </a>
                        </div>
                        <a class="href-block" href="{{ route('actions',['id' => $action->id]) }}">
                            @include('blocks.button_block', [
                                'primary' => true,
                                'icon' => 'icon-circle-right2',
                                'buttonText' => trans('content.details')
                            ])
                        </a>
                    </div>
                @endforeach
                <div class="paginator">{{ $actions->withQueryString()->links() }}</div>
            </x-row>
        </x-section>
    @endif
@endsection
