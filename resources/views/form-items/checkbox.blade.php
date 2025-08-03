<div class="form-check row">
    <label class="form-check-label d-inline-block">
        <input type="checkbox" name="{{ $inputName }}" class="form-check-input" value="1"
            {{ old($inputName, $attrValue) ? 'checked' : '' }}>
        {{ $label }}
    </label>
</div>
