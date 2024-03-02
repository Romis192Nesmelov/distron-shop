<div class="panel panel-flat">
    <x-atitle>{{ trans('admin.seo') }}</x-atitle>
    <div class="panel-body">
        @include('blocks.input_block', [
            'label' => trans('admin.page_title'),
            'name' => 'title',
            'type' => 'text',
            'placeholder' => trans('admin.page_title'),
            'value' => $seo ? $seo->title : ''
        ])
        @foreach($metas as $meta => $params)
            @include('blocks.input_block', [
                'label' => $params['name'] ? $params['name'] : $params['property'],
                'name' => $meta,
                'type' => 'text',
                'placeholder' => $params['name'] ? $params['name'] : $params['property'],
                'value' => $seo ? $seo[$meta] : ''
            ])
        @endforeach
    </div>
</div>
