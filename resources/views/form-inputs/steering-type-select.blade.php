@php
    $inputName = $inputName ?? 'steering_type';
    $attrName = $attrName ?? 'steering_type';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Руль';
    $required = $required ?? true;
    $inputId = $inputId ?? 'steering_type';
@endphp

<div class="mb-3">
    <label for="{{ $inputId }}">
        {{ $label }}
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>
    <select name="{{ $inputName }}" id="{{ $inputId }}"
        class="form-control {{ $errors->has($attrName) ? 'is-invalid' : '' }}" {{ $required ? 'required' : '' }}>
        <option value="">Выберите тип руля</option>
        @foreach ($steeringTypes as $steeringType)
            <option value="{{ $steeringType }}" {{ $steeringType == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $steeringType }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
