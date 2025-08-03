<div class="">
    <label for="{{ $inputId }}"> {{ $label }}
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>
    <textarea type="text" rows="10"
        class="form-control {{ $classes }} {{ $errors->has($attrName) ? 'is-invalid' : '' }}" name="{{ $inputName }}"
        {{ $required ? 'required' : '' }} id="{{ $inputId }}">{{ old($attrName, $attrValue) }}</textarea>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>
