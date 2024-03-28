@props([
    'wow_delay' => false,
    'head' => '',
    'wow_direction' => 'Left'
])
<div {{ $attributes->class('section') }}>
    <div class="container pad-block pb-0 {{ $wow_delay ? 'wow animate__animated animate__slideIn'.$wow_direction : '' }}" {{ $wow_delay ? 'data-wow-delay='.$wow_delay.'s' : '' }}>
        @if ($head)
            <h2 class="mt-4 text-center mb-5 wow animate__animated animate__fadeIn">{{ $head }}</h2>
        @endif
        {{ $slot }}
    </div>
</div>
