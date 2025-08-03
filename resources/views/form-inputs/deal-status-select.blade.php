<div class="form-group">
    <label for="{{ $inputId }}" class="form-label">{{ $label }} @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <select class="form-control @error($attrName) is-invalid @enderror" id="{{ $inputId }}" name="{{ $inputName }}"
        @if ($required) required @endif>
        <option value="">Выберите статус</option>
        @foreach (config('deal-statuses') as $key => $status)
            <option value="{{ $key }}" {{ $attrValue == $key ? 'selected' : '' }}>
                {{ $status }}
            </option>
        @endforeach
    </select>
    @error($attrName)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
