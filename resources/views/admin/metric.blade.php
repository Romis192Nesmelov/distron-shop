@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_metric') }}" method="post">
                @csrf
                @if (isset($metric))
                    @include('admin.blocks.hidden_id_block',['id' => $metric->id])
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        @include('blocks.input_block', [
                            'label' => trans('admin.metric_name'),
                            'name' => 'name',
                            'type' => 'text',
                            'max' => 255,
                            'placeholder' => trans('admin.metric_name'),
                            'value' => isset($metric) ? $metric->name : ''
                        ])
                        @include('blocks.textarea_block',[
                            'label' => trans('admin.metric_code'),
                            'name' => 'code',
                            'max' => 3000,
                            'placeholder' => trans('admin.metric_code'),
                            'value' => isset($metric) ? $metric->code : '',
                            'simple' => true
                        ])
                        @include('admin.blocks.checkbox_block',[
                            'name' => 'active',
                            'label' => trans('admin.metric_is_active'),
                            'checked' => isset($metric) ? $metric->active : true
                        ])
                    </div>
                </div>
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
