@php
    $inputName = $inputName ?? 'deal_type_id';
    $attrName = $attrName ?? 'deal_type_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Тип сделки';
    $required = $required ?? true;
    $inputId = $inputId ?? 'deal_type_id';

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
        <option value="">Выберите тип сделки</option>
        @foreach ($dealTypes as $dealType)
            <option value="{{ $dealType->id }}" {{ $dealType->id == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $dealType->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
