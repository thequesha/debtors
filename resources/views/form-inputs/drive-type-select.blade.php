@php
    $inputName = $inputName ?? 'drive_type';
    $attrName = $attrName ?? 'drive_type';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Тип привода';
    $required = $required ?? true;
    $inputId = $inputId ?? 'drive_type';
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
        <option value="">Выберите тип привода</option>
        @foreach ($driveTypes as $driveType)
            <option value="{{ $driveType }}" {{ $driveType == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $driveType }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
