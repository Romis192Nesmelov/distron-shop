<div class="item col-lg-{{ $col }} col-md-6 col-sm-12 mb-5 d-flex flex-column justify-content-between wow animate__animated animate__fadeInUp {{ $addClass ?? '' }}" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.1 }}s">
    <div class="w-100 text-center">
        <x-item_href href="{{ $href }}" slug="{{ $href == 'services' ? null : $item->type->slug }}" itemId="{{ $item->id }}">
            <div class="image mb-4" img="{{ $item->image ? asset($item->image) : asset($item->type->image) }}"></div>
            <div class="fs-5 fw-bold w-100 text-center">{{ getItemHead($item) }}</div>
            <p class="w-100 text-center lh-sm mb-2">{!! getItemProps($item) !!}</p>
            <p class="text-center lh-sm"><small>{{ mb_substr(strip_tags($item->description),0,60,'UTF-8').( mb_strlen(strip_tags($item->description), 'UTF-8') > 50 ? '…' : '') }}</small></p>
        </x-item_href>
    </div>
    <div class="text-center">
        <x-item_href href="{{ $href }}" slug="{{ $href == 'services' ? null : $item->type->slug }}" itemId="{{ $item->id }}">
            <p class="w-100 text-center fs-3">
                <strong>@include('blocks.price_block',['price' => $item->price])</strong>
            </p>
            @include('blocks.button_block', [
                'primary' => true,
                'icon' => 'icon-circle-right2',
                'buttonText' => trans('content.details')
            ])
        </x-item_href>
    </div>
</div>
