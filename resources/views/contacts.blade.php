@extends('layouts.main')

@section('content')
    <x-section wow_delay=".1" wow_direction="Right" head="{{ $menu['contacts']['name'] }}">
        <x-row>
            @include('blocks.contacts_block')
        </x-row>
    </x-section>
@endsection
