@php
    $inputName = $inputName ?? 'dealerships';
    $attrName = $attrName ?? 'dealerships';
    $attrValue = $attrValue ?? [];
    $label = $label ?? 'Автосалон';
    $required = $required ?? true;
    $inputId = $inputId ?? 'dealerships';
@endphp

<div class="mb-3">
    <label for="{{ $inputId }}">
        {{ $label }}
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>
    <select multiple name="{{ $inputName }}[]" id="{{ $inputId }}"
        class="form-control {{ $errors->has($attrName) ? 'is-invalid' : '' }}" {{ $required ? 'required' : '' }}>
        <option value="create_new" data-url="{{ route('dealerships.create') }}">
            ➕ Создать новый автосалон
        </option>
        @foreach ($dealerships as $dealership)
            <option value="{{ $dealership->id }}"
                {{ in_array($dealership->id, old($attrName, $attrValue)) ? 'selected' : '' }}>
                {{ $dealership->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
<script>
$(function() {
    $('#{{ $inputId }}').on('select2:select', function(e) {
        if (e.params.data.id === 'create_new') {
            var url = $(this).find('option[value="create_new"]').data('url');
            window.location.href = url;
        }
    });
});
</script>
@endpush
