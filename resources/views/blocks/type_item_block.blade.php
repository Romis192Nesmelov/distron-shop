<div class="item col-lg-{{ $col }} col-md-6 col-sm-12 mb-5 d-flex flex-column justify-content-between wow animate__animated animate__fadeInUp {{ $addClass ?? '' }}" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.1 }}s">
    <a class="href-block" href="{{ route($href,['slug' => ($href == 'services' ? null : $item->type->slug), 'id' => $item->id]) }}">
        <div class="w-100 text-center">
            <div class="image mb-4" img="{{ $item->image ? asset($item->image) : asset($item->type->image) }}"></div>
            <h5 class="w-100 text-center">{{ getItemHead($item) }}</h5>
            @if ($showDescription)
                <p class="text-center">{{ $item->description }}</p>
            @endif
            <p class="w-100 text-center lh-sm mb-2">{!! getItemProps($item) !!}</p>
        </div>
        <div class="text-center">
            <p class="w-100 text-center fs-3">
                <strong>@include('blocks.price_block',['price' => $item->price])</strong>
            </p>
            @include('blocks.button_block', [
                'primary' => true,
                'icon' => 'icon-circle-right2',
                'buttonText' => trans('content.details')
            ])
        </div>
    </a>
</div>
