@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_image') }}" method="post">
                @csrf
                @if (isset($image))
                    @include('admin.blocks.hidden_id_block',['id' => $image->id])
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            @include('admin.blocks.input_image_block',[
                                'name' => 'image',
                                'image' => isset($image) ? $image->image : ''
                            ])
                        </div>
                    </div>
                </div>
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
