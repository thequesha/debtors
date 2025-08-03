<div class="pb-3">
    <label for="status">Cтатус <span class="required">*</span></label>
    <select name="status" id="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
        <option value="active" {{ !$is_fired ? 'selected' : '' }}>Работает</option>
        <option value="fired" {{ $is_fired ? 'selected' : '' }}>Уволен</option>
    </select>
    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
</div>
