@php
    $required = $required ?? false;
    $label = $label ?? '';
    $inputName = $inputName ?? '';
    $attrName = $attrName ?? '';
    $attrValue = $attrValue ?? '';
    $inputId = $inputId ?? '';
    $placeholder = $placeholder ?? '';
    $enableTime = $enableTime ?? false;
    $dateFormat = $dateFormat ?? ($enableTime ? 'Y-m-d H:i' : 'Y-m-d');
@endphp

<div class="form-group mb-2">
    <label for="{{ $inputId }}" class="form-label small mb-1">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input 
        type="text" 
        class="form-control form-control-smx flatpickr-input" 
        id="{{ $inputId }}" 
        name="{{ $inputName }}" 
        value="{{ $attrValue }}" 
        placeholder="{{ $placeholder }}"
        data-enable-time="{{ $enableTime ? 'true' : 'false' }}"
        data-date-format="{{ $dateFormat }}"
        {{ $required ? 'required' : '' }}
    >
</div>
