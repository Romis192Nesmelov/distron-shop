<div class="panel panel-flat">
    @if (isset($head) && $head)
        <div class="panel-heading">
            <div class="panel-title">{{ $head }}</div>
        </div>
    @endif
    <div class="panel-body edit-image-preview">
        <a class="fancybox" href="{{ asset(isset($image) && $image ? $image : 'images/placeholder.jpg') }}">
            <div class="image" img="{{ asset(isset($image) && $image ? $image : 'images/placeholder.jpg') }}?{{ md5(rand(1,100000)*time()) }}"></div>
        </a>
        @include('admin.blocks.input_file_block', ['label' => '', 'name' =>  isset($name) && $name ? $name : 'image'])
    </div>
</div>
