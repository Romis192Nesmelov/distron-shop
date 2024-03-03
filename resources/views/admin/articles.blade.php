@extends('layouts.admin')

@section('content')
    @include('admin.blocks.modal_delete_block')

    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_article_seo') }}" method="post">
                @csrf
                @include('admin.blocks.seo_block',['seo' => $seo])
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>

    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            @include('admin.blocks.data_table_block', [
                'columns' => ['image','name','short_text'],
                'items' => $articles,
                'useEdit' => true,
                'useDelete' => true
            ])
        </div>
        @include('admin.blocks.add_button_block')
    </div>
    <script>window.dtRows = 4;</script>
@endsection
