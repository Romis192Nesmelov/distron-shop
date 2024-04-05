@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <div class="panel panel-flat">
                <div class="panel-body">
                    @include('admin.blocks.data_table_block', [
                        'columns' => ['image','name','text'],
                        'items' => $types,
                        'useEdit' => true,
                        'useDelete' => false
                    ])
{{--                    @include('admin.blocks.add_button_block')--}}
                </div>
            </div>

            <form class="form-horizontal" action="{{ route('admin.edit_products_seo') }}" method="post">
                @csrf
                @include('admin.blocks.seo_block',['seo' => $seo, 'seoHead' => trans('admin.seo_products')])
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
    <script>window.dtRows = 3;</script>
@endsection
