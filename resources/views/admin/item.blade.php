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
                @include('admin.blocks.hidden_id_block',['name' => 'type_id', 'id' => $parent->id])
                @include('admin.blocks.hidden_id_block',['name' => 'technology_id', 'id' => isset($item) ? $item->technology_id : 1])
                <div class="panel panel-flat">
                    <x-atitle>{{ trans('admin.type').': '.$parent->name }}</x-atitle>
                    <div class="panel-body">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            @include('admin.blocks.input_image_block',[
                                'name' => 'image',
                                'image' => isset($type) ? $item->image : ''
                            ])
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12 row">
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
                            @include('blocks.textarea_block', [
                                'label' => trans('admin.description'),
                                'name' => 'description',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.description'),
                                'value' => isset($item) ? $item->description : '',
                                'simple' => true
                            ])
                            @if ($parent->id == 1)
                                <div class="col-md-4 col-sm-12">
                                    @include('admin.blocks.select_block',[
                                        'name' => 'technology_id',
                                        'label' => trans('admin.technology'),
                                        'values' => $technologies,
                                        'option' => 'name',
                                        'selected' => isset($item) ? $item->technology_id : 1
                                    ])
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    @include('blocks.input_block', [
                                        'label' => trans('admin.capacity'),
                                        'name' => 'capacity',
                                        'type' => 'number',
                                        'placeholder' => trans('admin.capacity'),
                                        'min' => 100,
                                        'max' => 1000,
                                        'value' => isset($item) ? $item->capacity : 100
                                    ])
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    @include('blocks.input_block', [
                                        'label' => trans('admin.voltage'),
                                        'name' => 'voltage',
                                        'type' => 'number',
                                        'placeholder' => trans('admin.voltage'),
                                        'min' => 10,
                                        'max' => 100,
                                        'value' => isset($item) ? $item->voltage : 20
                                    ])
                                </div>
                            @elseif ($parent->id == 2)
                                @include('blocks.input_block', [
                                    'label' => trans('admin.plates'),
                                    'name' => 'plates',
                                    'type' => 'number',
                                    'placeholder' => trans('admin.plates'),
                                    'min' => 1,
                                    'max' => 20,
                                    'value' => isset($item) ? $item->plates : 2
                                ])
                            @endif
                        </div>
                    </div>
                </div>
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
