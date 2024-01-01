@props([
    'wow_delay' => false,
    'head' => '',
    'wow_direction' => 'Left'
])
<div {{ $attributes->class('section') }}>
    <div class="container pad-block pb-0 {{ $wow_delay ? 'wow animate__animated animate__slideIn'.$wow_direction : '' }}" {{ $wow_delay ? 'data-wow-delay='.$wow_delay.'s' : '' }}>
        @if ($head)
            <h2 class="mt-5 text-center mb-5">{{ $head }}</h2>
        @endif
        {{ $slot }}
    </div>
</div>
