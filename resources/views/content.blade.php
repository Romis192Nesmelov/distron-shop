@extends('layouts.main')

@section('content')
    <x-section class="pb-5" wow_delay=".1" head="{{ $content->name }}">
        @if ($content->id == 2)
            <div class="mb-5 wow animate__animated animate__fadeIn" data-wow-delay="0.5s" id="video" controls="controls" poster="{{ asset('storage/images/distron.jpg') }}">
                <video controls="controls" poster="{{ asset('storage/images/distron.jpg') }}">
                    @foreach ($video as $item)
                        <source src="{{ asset($item) }}" type='video/{{ pathinfo($item)['extension'] }};'>
                    @endforeach
                </video>
                <a id="look-at" href="{!! $settings['video'] !!}" target="_blank"><span>{{ trans('content.look_at') }}</span><img src="{{ asset('storage/images/ru_tube.png') }}" /></a>
            </div>
        @endif
        {!! $content->text !!}
    </x-section>
@endsection
