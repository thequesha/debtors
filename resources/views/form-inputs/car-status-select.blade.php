@php
    $inputName = $inputName ?? 'status';
    $attrName = $attrName ?? 'status';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Статус';
    $required = $required ?? true;
    $inputId = $inputId ?? 'status';
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
        <option value="">Выберите статус</option>
        @foreach ($carStatuses as $carStatus)
            <option value="{{ $carStatus }}" {{ $carStatus == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $carStatus }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
