@php
    $inputName = $inputName ?? 'color_id';
    $attrName = $attrName ?? 'color_id';
    $attrValue = $attrValue ?? null;
    $label = $label ?? 'Цвет';
    $required = $required ?? true;
    $inputId = $inputId ?? 'color_id';
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
        <option value="">Выберите цвет</option>
        @foreach ($colors as $color)
            <option class="position-relative" value="{{ $color->id }}" data-color="{{ $color->hex }}"
                {{ $color->id == old($attrName, $attrValue) ? 'selected' : '' }}>
                {{ $color->name }}
            </option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first($attrName) }}</div>
</div>

@push('js')
    <script>
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }

            var colorHex = $(state.element).data('color');
            var $state = $(
                '<span><span style="border-radius: 4px; display: inline-block; width: 20px; height: 20px; margin-right: 5px; vertical-align: middle; background-color: ' +
                colorHex + '"></span>' +
                state.text + '</span>'
            );
            return $state;
        };

        $("#{{ $inputId }}").select2({
            templateResult: formatState,
            templateSelection: formatState
        });
    </script>
@endpush
