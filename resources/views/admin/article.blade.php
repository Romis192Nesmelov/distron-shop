@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_article') }}" method="post">
                @csrf
                @if (isset($article))
                    @include('admin.blocks.hidden_id_block',['id' => $article->id])
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            @include('admin.blocks.input_image_block',[
                                'name' => 'image',
                                'image' => isset($article) ? $article->image : ''
                            ])
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            @include('blocks.input_block', [
                                'label' => trans('admin.name'),
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 50,
                                'placeholder' => trans('admin.name'),
                                'value' => isset($article) ? $article->name : ''
                            ])
                            @include('blocks.input_block', [
                                'label' => trans('admin.short_text'),
                                'name' => 'short_text',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.short_text'),
                                'value' => isset($article) ? $article->short_text : ''
                            ])
                            @include('blocks.textarea_block',[
                                'label' => trans('admin.text'),
                                'name' => 'text',
                                'max' => 3000,
                                'placeholder' => trans('admin.text'),
                                'value' => isset($article) ? $article->text : '',
                                'simple' => false
                            ])
                        </div>
                    </div>
                </div>
                @include('admin.blocks.seo_block',['seo' => isset($article) ? $article->seo : null])
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
