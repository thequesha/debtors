@php
    $inputName = $inputName ?? 'vp';
    $attrName = $attrName ?? 'vp';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'ПТС';
    $required = $required ?? true;
    $inputId = $inputId ?? 'vp';
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
        <option value="">Выберите тип ПТС</option>
        @foreach ($vpTypes as $vpType)
            <option value="{{ $vpType }}" {{ $vpType == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $vpType }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
