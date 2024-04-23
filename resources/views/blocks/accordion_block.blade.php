<div class="accordion-item wow animate__animated animate__fadeInUp" data-wow-offset="10" data-wow-delay="{{ ($k + 1) * 0.3 }}s">
    <h2 class="accordion-header" id="{{ $itemId }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $itemId }}" aria-expanded="false" aria-controls="collapse{{ $itemId }}">{{ $itemHead }}</button>
    </h2>
    <div id="collapse{{ $itemId }}" class="accordion-collapse collapse" aria-labelledby="{{ $itemId }}" data-bs-parent="#{{ $parentId }}">
        <div class="accordion-body">{{ $itemText }}</div>
    </div>
</div>
