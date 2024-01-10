@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_item') }}" method="post">
                @csrf
                @if (isset($item))
                    @include('admin.blocks.hidden_id_block',['id' => $item->id])
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            @include('admin.blocks.select_block',[
                                'name' => 'type_id',
                                'label' => trans('admin.type'),
                                'values' => $parents,
                                'option' => 'name',
                                'selected' => request('parent_id')
                            ])
                            @include('admin.blocks.input_image_block',[
                                'name' => 'image',
                                'image' => isset($type) ? $item->image : ''
                            ])
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            @include('blocks.input_block', [
                                'label' => trans('admin.price'),
                                'name' => 'price',
                                'type' => 'number',
                                'placeholder' => trans('admin.price'),
                                'value' => isset($item) ? $item->price : ''
                            ])
                            @include('blocks.input_block', [
                                'label' => trans('admin.name'),
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 50,
                                'placeholder' => trans('admin.name'),
                                'value' => isset($item) ? $item->name : ''
                            ])
                            @include('blocks.input_block', [
                                'label' => trans('admin.short_description'),
                                'name' => 'short_description',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.short_description'),
                                'value' => isset($item) ? $item->short_description : ''
                            ])
                            @include('blocks.textarea_block',[
                                'label' => trans('admin.long_description'),
                                'name' => 'long_description',
                                'max' => 3000,
                                'placeholder' => trans('admin.long_description'),
                                'value' => isset($item) ? $item->long_description : '',
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
