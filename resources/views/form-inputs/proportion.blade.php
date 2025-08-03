<div class=" form-group">
    <label for="proportion">
        {{ __('proportion') }} <span class="text-danger">*</span>
    </label>
    <div class=" ">
        <input id="proportion" type="number" min="0.1" step="0.1"
            class="form-control{{ $errors->has('proportion') ? ' is-invalid' : '' }}" name="proportion"
            value="{{ old('proportion', $attrValue) }}" required>
        @if ($errors->has('proportion'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('proportion') }}</strong>
            </span>
        @endif
    </div>
</div>
