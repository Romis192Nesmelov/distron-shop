@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_icon') }}" method="post">
                @csrf
                @if (isset($icon))
                    @include('admin.blocks.hidden_id_block',['id' => $icon->id])
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-2 col-sm-12 col-xs-12">
                            @include('admin.blocks.input_image_block',[
                                'name' => 'image',
                                'image' => isset($icon) ? $icon->image : ''
                            ])
                        </div>
                        <div class="col-md-10 col-sm-12 col-xs-12">
                            @include('blocks.input_block', [
                                'label' => trans('admin.title'),
                                'name' => 'title',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.title'),
                                'value' => isset($icon) ? $icon->title : ''
                            ])
                            @include('admin.blocks.checkbox_block',[
                                'name' => 'active',
                                'label' => trans('admin.active'),
                                'checked' => isset($icon) ? $icon->active : true
                            ])
                        </div>
                    </div>
                </div>
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
