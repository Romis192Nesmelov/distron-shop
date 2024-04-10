@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <div class="panel panel-flat">
                <div class="panel-body">
                    @include('admin.blocks.data_table_block', [
                        'columns' => ['contact'],
                        'items' => $contacts,
                        'useEdit' => true,
                        'useDelete' => false
                    ])
                </div>
            </div>

            <form class="form-horizontal" action="{{ route('admin.edit_contacts_seo') }}" method="post">
                @csrf
                @include('admin.blocks.seo_block',['seo' => $seo, 'seoHead' => trans('admin.seo_products')])
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
    <script>window.dtRows = 1;</script>
@endsection
