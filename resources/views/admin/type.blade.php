@extends('layouts.admin')

@section('content')
    @include('admin.blocks.modal_delete_block', ['custom_key' => 'item'])
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_type') }}" method="post">
                @csrf
                @if (isset($type))
                    @include('admin.blocks.hidden_id_block',['id' => $type->id])
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            @include('admin.blocks.input_image_block',[
                                'name' => 'image',
                                'image' => isset($type) ? $type->image : ''
                            ])
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            @include('blocks.input_block', [
                                'label' => trans('admin.name'),
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 50,
                                'placeholder' => trans('admin.name'),
                                'value' => isset($type) ? $type->name : ''
                            ])
                            @include('blocks.textarea_block',[
                                'label' => trans('admin.text'),
                                'name' => 'text',
                                'max' => 3000,
                                'placeholder' => trans('admin.text'),
                                'value' => isset($type) ? $type->text : '',
                                'simple' => false
                            ])
                        </div>
                    </div>
                </div>
                @include('admin.blocks.seo_block',['seo' => isset($type) ? $type->seo : null])
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>

    @if (isset($type))
        <div class="panel panel-flat">
            <x-atitle>{{ trans('admin.items') }}</x-atitle>
            <div class="panel-body">
                @if ($type->items->count())
                    @include('admin.blocks.data_table_block', [
                        'columns' => ['image','name','description','price'],
                        'items' => $type->items,
                        'route' => 'items',
                        'parent_id' => $type->id,
                        'useEdit' => true,
                        'useDelete' => true
                    ])
                @endif
                @include('admin.blocks.add_button_block', [
                    'route' => 'items',
                    'custom_key' => 'items',
                    'parent_id' => $type->id,
                ])
            </div>
        </div>
        <script>window.dtRows = 5;</script>
    @endif
@endsection
