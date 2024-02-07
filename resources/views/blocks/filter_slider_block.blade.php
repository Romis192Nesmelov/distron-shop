<input type="hidden" name="min_{{ $name }}" value="{{ $minVal }}"/>
<input type="hidden" name="max_{{ $name }}" value="{{ $maxVal }}"/>
<h3 class="{{ $mt ? 'mt-4' : '' }} mb-2">{{ trans('content.'.$name) }}</h3>
<div id="range-slider-{{ $name }}"></div>
