@extends('layouts.main')

@section('content')
    <x-section wow_delay=".1" head="{{ trans('menu.articles') }}">
        <x-row>
            @if ($articles->count())
                @foreach($articles as $k => $article)
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-4 d-flex flex-column justify-content-between wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.2 }}s">
                        <div class="mb-3">
                            <a class="href-block" href="{{ route('articles',['slug' => $article->slug]) }}">
                                <div class="image w-100 mb-3" img="{{ asset($article->image) }}"></div>
                                <h4 class="w-100 text-center">{{ $article->name }}</h4>
                                <p>{{ $article->short_text }}</p>
                            </a>
                        </div>
                        <a class="href-block" href="{{ route('articles',['slug' => $article->slug]) }}">
                            @include('blocks.button_block', [
                                'primary' => true,
                                'icon' => 'icon-circle-right2',
                                'buttonText' => trans('content.details')
                            ])
                        </a>
                    </div>
                @endforeach
                <div class="paginator">{{ $articles->links() }}</div>
            @else
                <h4 class="w-100 text-center mb-5">{{ trans('content.no_articles') }}</h4>
            @endif
        </x-row>
    </x-section>
@endsection
