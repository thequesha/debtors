@php
    $inputName = $inputName ?? 'element';
    $attrName = $attrName ?? 'element';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Элемент';
    $required = $required ?? true;
    $inputId = $inputId ?? 'element';
@endphp

<div class="mb-3">
    <label for="{{ $inputId }}">
        {{ $label }}
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>
    <select name="{{ $inputName }}" id="{{ $inputId }}"
        class="form-control test-drive-element-select {{ $errors->has($attrName) ? 'is-invalid' : '' }}"
        {{ $required ? 'required' : '' }}>
        <option value="">Выберите элемент</option>
        @foreach ($elements as $element)
            <option value="{{ $element }}" {{ $element == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $element }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script>
        $('#' + '{{ $inputId }}').select2();
    </script>
@endpush
