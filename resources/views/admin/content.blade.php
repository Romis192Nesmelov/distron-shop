@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_content') }}" method="post">
                @csrf
                @include('admin.blocks.hidden_id_block',['id' => $content->id])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            @include('admin.blocks.input_image_block',[
                                'name' => 'image',
                                'image' => $content->image
                            ])
                        </div>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            @include('blocks.input_block', [
                                'label' => trans('admin.head'),
                                'name' => 'head',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.head'),
                                'value' => $content->head
                            ])
                            @include('blocks.textarea_block',[
                                'label' => trans('admin.text'),
                                'name' => 'text',
                                'max' => 3000,
                                'placeholder' => trans('admin.text'),
                                'value' => $content->text,
                                'simple' => false
                            ])
                        </div>
                    </div>
                </div>
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
