<a class="fancybox w-100" href="{{ $item->image ? asset($item->image) : asset($item->type->image) }}">
    <div {{ isset($id) ? 'id='.$id : '' }} class="image mb-4 {{ $addClass ?? '' }}" img="{{ $item->image ? asset($item->image) : asset($item->type->image) }}"></div>
</a>
