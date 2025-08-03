@php
    $inputName = $inputName ?? 'car_category_id';
    $attrName = $attrName ?? 'car_category_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Категория';
    $required = $required ?? true;
    $inputId = $inputId ?? 'car_category_id';
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
        <option value="">Выберите категорию</option>
        @foreach ($carCategories as $carCategory)
            <option value="{{ $carCategory->id }}"
                {{ $carCategory->id == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $carCategory->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
