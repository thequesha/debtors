@php
    $inputName = $inputName ?? 'body_part';
    $attrName = $attrName ?? 'body_part';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Кузовная часть';
    $required = $required ?? true;
    $inputId = $inputId ?? 'body_part';
@endphp

<div class="mb-3">
    <label for="{{ $inputId }}">
        {{ $label }}
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>
    <select name="{{ $inputName }}" id="{{ $inputId }}"
        class="form-control body_part_damage {{ $errors->has($attrName) ? 'is-invalid' : '' }}"
        {{ $required ? 'required' : '' }}>
        <option value="">Выберите из списка</option>
        @foreach ($damages as $damage)
            <option value="{{ $damage }}" {{ $damage == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $damage }}
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
