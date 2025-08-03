@php
    $inputName = $inputName ?? 'contract_type_id';
    $attrName = $attrName ?? 'contract_type_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Тип контракта';
    $required = $required ?? true;
    $inputId = $inputId ?? 'contract_type_id';

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
        <option value="">Выберите тип контракта</option>
        @foreach ($contractTypes as $contractType)
            <option value="{{ $contractType->id }}"
                {{ $contractType->id == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $contractType->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
