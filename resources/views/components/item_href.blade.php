@props([
    'href' => '',
    'slug' => '',
    'itemId' => 0
])
<a class="href-block" href="{{ route($href,['slug' => $slug, 'id' => $itemId]) }}">
    {{ $slot }}
</a>
