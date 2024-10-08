@extends('layouts.admin')

@section('content')
    @include('admin.blocks.modal_delete_block')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            @include('admin.blocks.data_table_block', [
                'columns' => ['image','active'],
                'items' => $diplomas,
                'useEdit' => true,
                'useDelete' => true
            ])
        </div>
        @include('admin.blocks.add_button_block')
    </div>
    <script>window.dtRows = 3;</script>
@endsection
