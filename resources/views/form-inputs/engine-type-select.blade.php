@php
    $inputName = $inputName ?? 'engine_type';
    $attrName = $attrName ?? 'engine_type';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Тип двигателя';
    $required = $required ?? true;
    $inputId = $inputId ?? 'engine_type';
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
        <option value="">Выберите тип двигателя</option>
        @foreach ($engineTypes as $engineType)
            <option value="{{ $engineType }}" {{ $engineType == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $engineType }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
