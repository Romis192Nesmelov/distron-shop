@extends('layouts.main')

@section('content')
    <x-section class="pb-5" wow_delay=".1" head="{{ $content->name }}">
        {!! $content->text !!}
    </x-section>
@endsection
