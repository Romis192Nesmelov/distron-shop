<div class="col-lg-{{ $col }} col-md-6 col-sm-12 mb-5 d-flex flex-column justify-content-between wow animate__animated animate__fadeInUp {{ $addClass ?? '' }}" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.1 }}s">
    <div>
        @include('blocks.item_image_block',['addClass' => 'w-100'])
        <h5 class="w-100 text-center">@include('blocks.item_head_block')</h5>
        @include('blocks.item_props_block', ['addClass' => 'w-100 text-center lh-sm mb-2'])
    </div>
    <div class="text-center">
        <p class="w-100 text-center fs-3">
            <strong>@include('blocks.price_block',['price' => $item->price])</strong>
        </p>
        <a href="{{ route('get_items',['slug' => $item->type->slug, 'id' => $item->id]) }}">
            @include('blocks.button_block', [
                'primary' => true,
                'icon' => 'icon-circle-right2',
                'buttonText' => trans('content.details')
            ])
        </a>
    </div>
</div>
