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
                            'max' => 50000,
                            'placeholder' => trans('admin.text'),
                            'value' => $content->text,
                            'simple' => false
                        ])
                    </div>
                </div>
                @include('admin.blocks.seo_block',['seo' => $content->seo])
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
