@extends('layouts.main')

@section('content')
    <x-section data-scroll-destination="catalogue" head="{{ trans('menu.products') }}">
        @include('blocks.products_block')
    </x-section>
@endsection
