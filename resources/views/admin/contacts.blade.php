@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            @include('admin.blocks.data_table_block', [
                'columns' => ['contact'],
                'items' => $contacts,
                'useEdit' => true,
                'useDelete' => false
            ])
        </div>
    </div>
    <script>window.dtRows = 0;</script>
@endsection
