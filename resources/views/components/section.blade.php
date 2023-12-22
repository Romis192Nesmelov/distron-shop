@props([
    'wow_delay' => false,
    'head' => ''
])
<div {{ $attributes->class('section') }}>
    <div class="container pad-block pb-0 {{ $wow_delay ? 'wow animate__animated animate__fadeIn' : '' }}" {{ $wow_delay ? 'data-wow-delay='.$wow_delay.'s' : '' }}>
        @if ($head)
            <h2 class="mt-5">{{ $head }}</h2>
        @endif
        {{ $slot }}
    </div>
</div>
