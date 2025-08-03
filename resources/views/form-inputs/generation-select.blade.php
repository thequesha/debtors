@php
    $inputName = $inputName ?? 'generation_id';
    $attrName = $attrName ?? 'generation_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Поколение';
    $required = $required ?? true;
    $inputId = $inputId ?? 'generation_id';
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
        <option value="">Выберите поколение</option>
        @foreach ($generations as $generation)
            <option value="{{ $generation->id }}" {{ $generation->id == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $generation->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
