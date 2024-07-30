@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_diploma') }}" method="post">
                @csrf
                @if (isset($diploma))
                    @include('admin.blocks.hidden_id_block',['id' => $diploma->id])
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            @include('admin.blocks.input_image_block',[
                                'name' => 'image',
                                'image' => isset($diploma) ? $diploma->image : ''
                            ])
                            @include('blocks.input_block', [
                                'label' => trans('admin.alt_image'),
                                'name' => 'alt_img',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.alt_image'),
                                'value' => isset($diploma) ? $diploma->alt_img : ''
                            ])
                            @include('admin.blocks.checkbox_block',[
                                'name' => 'active',
                                'label' => trans('admin.active'),
                                'checked' => isset($diploma) ? $diploma->active : true
                            ])
                        </div>
                    </div>
                </div>
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
