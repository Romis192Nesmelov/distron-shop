<td class="text-center image-cell">
    @if ($item[$column])
        <a href="{{ isset($column_full) ? asset($item[$column_full]) : asset($item[$column]) }}" class="fancybox">
            <div class="image" img="{{ isset($column_preview) ? asset($item[$column_preview]) : asset($item[$column]) }}"></div>
        </a>
    @endif
</td>
