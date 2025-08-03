@php
    $inputName = $inputName ?? 'user_id';
    $attrName = $attrName ?? 'user_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Кто привел';
    $required = $required ?? true;
    $inputId = $inputId ?? 'user_id';
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
        <option value="">Выберите пользователя</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ $user->id == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script></script>
@endpush
