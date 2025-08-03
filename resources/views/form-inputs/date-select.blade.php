@php
    $inputName = $inputName ?? 'birth_date';
    $attrName = $attrName ?? 'birth_date';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Дата рождения';
    $required = $required ?? true;
    $inputId = $inputId ?? 'datePickerExample';
@endphp

<div class="mb-3">
    <label for="{{ $inputId }}" class="form-label">
        {{ $label }}
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>
    <div class="input-group date datepicker">
        <input type="text" class="form-control {{ $errors->has($attrName) ? 'is-invalid' : '' }}"
            id="{{ $inputId }}" name="{{ $inputName }}" value="{{ old($attrName, $attrValue) }}"
            {{ $required ? 'required' : '' }} data-provide="datepicker" data-date-autoclose="true"
            data-date-today-highlight="true" data-date-language="ru">
    </div>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>
