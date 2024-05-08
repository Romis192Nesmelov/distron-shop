@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_action') }}" method="post">
                @csrf
                @if (isset($action))
                    @include('admin.blocks.hidden_id_block',['id' => $action->id])
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="panel panel-flat">
                            <div class="panel-body edit-image-preview">
                                @if (isset($action))
                                    <img class="image" src="{{ asset($action->image) }}" />
                                @endif
                                @include('admin.blocks.input_file_block', ['label' => '', 'name' =>  isset($name) && $name ? $name : 'image'])
                            </div>
                        </div>
                        @include('blocks.input_block', [
                            'label' => trans('admin.alt_image'),
                            'name' => 'alt_img',
                            'type' => 'text',
                            'max' => 255,
                            'placeholder' => trans('admin.alt_image'),
                            'value' => isset($action) ? $action->alt_img : ''
                        ])

                        @include('blocks.input_block', [
                            'label' => 'URI',
                            'name' => 'slug',
                            'type' => 'text',
                            'max' => 100,
                            'placeholder' => 'URI',
                            'value' => isset($action) ? $action->slug : ''
                        ])
                        @include('blocks.input_block', [
                            'label' => trans('admin.simple_name'),
                            'name' => 'name',
                            'type' => 'text',
                            'max' => 50,
                            'placeholder' => trans('admin.simple_name'),
                            'value' => isset($action) ? $action->name : ''
                        ])
                        @include('blocks.textarea_block',[
                            'label' => trans('admin.text'),
                            'name' => 'text',
                            'max' => 3000,
                            'placeholder' => trans('admin.text'),
                            'value' => isset($action) ? $action->text : '',
                            'simple' => false
                        ])
                        @include('admin.blocks.checkbox_block',[
                            'name' => 'active',
                            'label' => trans('admin.active'),
                            'checked' => isset($action) ? $action->active : true
                        ])
                    </div>
                </div>
                @include('admin.blocks.seo_block',['seo' => isset($action) ? $action->seo : null])
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
