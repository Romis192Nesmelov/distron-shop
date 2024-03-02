@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.settings') }}</x-atitle>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_settings') }}" method="post">
                @csrf
                @include('blocks.input_block', [
                    'label' => trans('admin.rutube_video'),
                    'name' => 'video',
                    'type' => 'text',
                    'placeholder' => trans('admin.rutube_video'),
                    'value' => $settings['video']
                ])
                @include('admin.blocks.seo_block',['seo' => $seo])
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
