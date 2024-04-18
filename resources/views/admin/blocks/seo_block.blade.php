<div class="panel-group panel-group-control panel-group-control-right content-group-lg" id="accordion-control-right">
    <div class="panel panel-white">
        <div class="panel-heading">
            <x-atitle>
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group">
                    {{ $seoHead ?? trans('admin.seo') }}
                </a>
            </x-atitle>
        </div>
        <div id="accordion-control-right-group" class="panel-collapse collapse">
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
    </div>
</div>
