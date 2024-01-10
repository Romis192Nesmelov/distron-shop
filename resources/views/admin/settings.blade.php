@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin.seo') }}</x-atitle>
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
                @include('blocks.input_block', [
                    'label' => trans('admin.page_title'),
                    'name' => 'title',
                    'type' => 'text',
                    'placeholder' => trans('admin.page_title'),
                    'value' => $seo['title']
                ])
                @foreach($metas as $meta => $params)
                    @if (isset($seo[$meta]))
                        @include('blocks.input_block', [
                            'label' => $params['name'] ? $params['name'] : $params['property'],
                            'name' => $meta,
                            'type' => 'text',
                            'placeholder' => $params['name'] ? $params['name'] : $params['property'],
                            'value' => $seo[$meta]
                        ])
                    @endif
                @endforeach
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
