@php
    $inputName = $inputName ?? 'make_id';
    $attrName = $attrName ?? 'make_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Модель';
    $required = $required ?? true;
    $inputId = $inputId ?? 'make_id';
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
        <option value="">Выберите модель</option>
        @foreach ($makes as $make)
            <option value="{{ $make->id }}" {{ $make->id == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $make->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
