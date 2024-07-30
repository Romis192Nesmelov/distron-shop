<div class="diploma text-center mt-3 mb-3 col-lg-{{ $col }} col-md-6 col-sm-6 col-xs-12 wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.3 }}s">
    <a class="fancybox" href="{{ asset($diploma->image) }}">
        <img src="{{ asset($diploma->image) }}" {!! $diploma->alt_img ? 'alt="'.$diploma->alt_img.'"' : '' !!}>
    </a>
</div>
