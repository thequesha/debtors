<div class="pb-3">
    <label for="is_collateral">В залоге <span class="required">*</span></label>
    <select name="is_collateral" id="is_collateral"
        class="form-control {{ $errors->has('is_collateral') ? 'is-invalid' : '' }}">
        <option value="0" {{ !$is_collateral ? 'selected' : '' }}>Нет</option>
        <option value="1" {{ $is_collateral ? 'selected' : '' }}>В залоге</option>
    </select>
    <div class="invalid-feedback">{{ $errors->first('is_collateral') }}</div>
</div>
