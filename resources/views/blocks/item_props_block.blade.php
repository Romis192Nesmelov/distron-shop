@if ($showDescription)
    <p class="{{ $addClass ?? '' }}">{{ $item->description }}</p>
@endif
@foreach (['capacity','voltage','plates'] as $prop)
    @if ($item[$prop])
        <p class="{{ $addClass ?? '' }}">{!! trans('content.'.$prop.'_val',['val' => $item[$prop]]) !!}</p>
    @endif
@endforeach
