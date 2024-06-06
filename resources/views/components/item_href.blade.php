@props([
    'href' => '',
    'slug' => '',
    'itemSlug' => '',
    'itemId' => 0,
])
<a class="href-block" href="{{ route($href,($itemSlug ? ['slug' => $slug, 'item_slug' => $itemSlug] : ['slug' => $slug, 'id' => $itemId])) }}">
    {{ $slot }}
</a>
