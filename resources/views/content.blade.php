@extends('layouts.main')

@section('content')
    <x-section class="pb-5" wow_delay=".1" head="{{ $content->name }}">
        <div class="col-lg-3 col-md-6 col-sm-12 float-start me-lg-4 me-md-4 me-sm-0">
            <a class="fancybox" href="{{ asset($content->image) }}">
                <div class="image w-100" img="{{ asset($content->image) }}"></div>
            </a>
        </div>
        {!! $content->text !!}
    </x-section>
@endsection
