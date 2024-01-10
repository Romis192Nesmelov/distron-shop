<table class="table table-striped table-items">
    <tr>
        <th>{{ trans('admin.image') }}</th>
        @include('admin.blocks.th_delete_cell_block')
    </tr>
    @foreach ($items as $item)
        <tr role="row">
            @include('admin.blocks.datatable_image_block', ['column' => 'image'])
            @include('admin.blocks.delete_cell_block',[
                'id' => $item->id,
                'deleteModal' => $deleteImageModal ?? 'delete-image-modal'
            ])
        </tr>
    @endforeach
</table>
