<div class="pb-3">
    <label for="has_restriction_on_registration">Ограничения на регистрацию <span class="required">*</span></label>
    <select name="has_restriction_on_registration" id="has_restriction_on_registration"
        class="form-control {{ $errors->has('has_restriction_on_registration') ? 'is-invalid' : '' }}">
        <option value="0" {{ !$has_restriction_on_registration ? 'selected' : '' }}>Нет</option>
        <option value="1" {{ $has_restriction_on_registration ? 'selected' : '' }}>Есть ограничения</option>
    </select>
    <div class="invalid-feedback">{{ $errors->first('has_restriction_on_registration') }}</div>
</div>
