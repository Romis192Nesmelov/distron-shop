@extends('layouts.admin')

@section('content')
    @include('admin.blocks.modal_delete_block')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            @include('admin.blocks.data_table_block', [
                'columns' => ['number','user','notes','status','delivery'],
                'items' => $orders,
                'useEdit' => true,
                'useDelete' => true
            ])
        </div>
    </div>
    <script>window.dtRows = 5;</script>
@endsection
