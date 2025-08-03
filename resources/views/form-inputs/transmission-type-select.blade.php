@php
    $inputName = $inputName ?? 'transmission_type';
    $attrName = $attrName ?? 'transmission_type';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Коробка передач';
    $required = $required ?? true;
    $inputId = $inputId ?? 'transmission_type';
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
        <option value="">Выберите тип коробки передач</option>
        @foreach ($transmissionTypes as $transmissionType)
            <option value="{{ $transmissionType }}"
                {{ $transmissionType == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $transmissionType }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
