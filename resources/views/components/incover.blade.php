@props([
    'labelClass' => '',
    'name' => '',
    'error' => null,
    'label' => null,
    'ajax' => true
])

@if ($label)
    <label {{ $labelClass ? 'class='.$labelClass : '' }} for="{{ $name }}">{{ $label }}</label>
@endif
<div class="form-group {{ $error ? "error" : '' }}">
    {!! $slot !!}
    @include('blocks.wrap_error_block', ['ajax' => $ajax])
</div>
