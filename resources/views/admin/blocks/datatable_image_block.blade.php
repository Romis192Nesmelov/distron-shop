<td class="text-center image">
    @if ($item[$column])
        <a href="{{ isset($column_full) ? asset($item[$column_full]) : asset($item[$column]) }}" class="fancybox">
            <img src="{{ isset($column_preview) ? asset($item[$column_preview]) : asset($item[$column]) }}" />
        </a>
    @endif
</td>
