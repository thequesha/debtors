@php
    $inputName = $inputName ?? 'body_type_id';
    $attrName = $attrName ?? 'body_type_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Конфигурация кузова';
    $required = $required ?? true;
    $inputId = $inputId ?? 'body_type_id';

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
        <option value="">Выберите конфигурацию кузова</option>
        @foreach ($bodyTypes as $bodyType)
            <option value="{{ $bodyType->id }}" {{ $bodyType->id == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $bodyType->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
