@php
    $inputName = $inputName ?? 'legal_form';
    $attrName = $attrName ?? 'legal_form';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Юридическая форма';
    $required = $required ?? true;
    $inputId = $inputId ?? 'legal_form';
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
        <option value="">Выберите юридическую форму</option>
        @foreach ($legalForms as $legalForm)
            <option value="{{ $legalForm }}" {{ $legalForm == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $legalForm }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
