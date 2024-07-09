@props([
    'href' => '',
    'slug' => '',
    'itemSlug' => '',
    'itemId' => 0,
])
@if ($slug && $itemSlug)
    <a class="href-block" href="{{ route($href, ['slug' => $slug, 'item_slug' => $itemSlug]) }}">
        {{ $slot }}
    </a>
@elseif ($slug && $itemId)
    <a class="href-block" href="{{ route($href, ['slug' => $slug, 'id' => $itemId]) }}">
        {{ $slot }}
    </a>
@elseif ($itemSlug)
    <a class="href-block" href="{{ route($href, ['slug' => $itemSlug]) }}">
        {{ $slot }}
    </a>
@else
    <a class="href-block" href="{{ route($href, ['id' => $itemId]) }}">
        {{ $slot }}
    </a>
@endif
