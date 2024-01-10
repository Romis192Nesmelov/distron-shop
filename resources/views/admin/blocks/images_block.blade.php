<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.'.$route) }}" method="post">
                @csrf
                @include('blocks.hidden_id_block',['name' => $hiddenIdName, 'id' => $item->id])
                @include('admin.blocks.input_image_block',['head' => trans('admin.add_image')])
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
</div>
<div class="col-lg-8 col-md-6 col-sm-12">
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin.images') }}</x-atitle>
        <div class="panel-body">
            @include('admin.blocks.data_table_images_block', ['items' => $item->images])
        </div>
    </div>
</div>
