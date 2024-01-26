<a class="fancybox" href="{{ $item->image ? asset($item->image) : asset($item->type->image) }}">
    <img {{ isset($id) ? 'id='.$id : '' }} class="image mb-4 {{ $addClass ?? '' }}" src="{{ $item->image ? asset($item->image) : asset($item->type->image) }}" />
</a>
