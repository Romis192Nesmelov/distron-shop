@if ($item->type_id == 1)
    {{ $item->technology->name }}
@elseif ($item->name)
    {{ $item->name }}
@else
    {{ $item->type->name }}
@endif
