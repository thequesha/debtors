@php
    $inputName = $inputName ?? 'receipt_source_id';
    $attrName = $attrName ?? 'receipt_source_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Источник поступления';
    $required = $required ?? true;
    $inputId = $inputId ?? 'receipt_source_id';
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
        <option value="">Выберите источник</option>
        @foreach ($receiptSources as $receiptSource)
            <option value="{{ $receiptSource->id }}"
                {{ $receiptSource->id == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $receiptSource->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
