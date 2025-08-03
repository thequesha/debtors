@php
    $inputName = $inputName ?? 'mark_id';
    $attrName = $attrName ?? 'mark_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Марка';
    $required = $required ?? true;
    $inputId = $inputId ?? 'mark_id';
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
        <option value="">Выберите марку</option>
        @foreach ($marks as $mark)
            <option value="{{ $mark->id }}" {{ $mark->id == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $mark->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
