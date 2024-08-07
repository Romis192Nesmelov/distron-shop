<div class="icon text-center mb-3 col-lg-{{ $col }} col-md-6 col-sm-6 col-xs-12 wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.3 }}s">
    <img src="{{ asset($icon->image) }}" {!! $icon->alt_img ? 'alt="'.$icon->alt_img.'"' : '' !!}>
    <h6 class="mt-2 text-center">{{ $icon->title }}</h6>
    @if (isset($icon->description) && $icon->description)
        <p class="text-center">{{ $icon->description }}</p>
    @endif
</div>
