@foreach ($buttons as $k => $button)
    <div class="form-check">
        <input class="form-check-input" type="radio" value="{{ $button['value'] }}" {{ isset($checked) && $checked == $button['value'] ? 'checked=checked' : '' }} name="{{ $name }}" id="{{ $name.($k+1) }}">
        <label class="form-check-label" for="{{ $name.($k+1) }}">{{ $button['label'] }}</label>
    </div>
@endforeach
