@extends('layouts.main')

@section('content')
    <x-section class="pb-5" wow_delay=".1" head="{{ $article->name }}">
        <div class="col-lg-3 col-md-6 col-sm-12 float-start me-lg-4 me-md-4 me-sm-0">
            <a class="fancybox" href="{{ asset($article->image) }}">
                <img class="w-100 border" {{ $article->alt_img ? 'alt='.$article->alt_img : '' }} src="{{ asset($article->image) }}" />
            </a>
        </div>
        <p class="fst-italic fw-bold fs-6 mb-3">{{ $article->short }}</p>
        {!! $article->text !!}
    </x-section>
@endsection
