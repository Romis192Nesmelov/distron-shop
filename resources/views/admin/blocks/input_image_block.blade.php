<div class="panel panel-flat">
    @if (isset($head) && $head)
        <div class="panel-heading">
            <div class="panel-title">{{ $head }}</div>
        </div>
    @endif
    <div class="panel-body edit-image-preview">
        @if (isset($image) && $image)
            <a class="fancybox" href="{{ asset($image) }}">
                <div class="image" img="{{ asset($image) }}?{{ md5(rand(1,100000)*time()) }}"></div>
            </a>
        @else
            <img src="{{ asset('images/placeholder.jpg') }}" />
        @endif
        @include('admin.blocks.input_file_block', ['label' => '', 'name' =>  isset($name) && $name ? $name : 'image'])
    </div>
</div>
