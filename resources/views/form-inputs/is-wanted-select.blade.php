<div class="pb-3">
    <label for="is_wanted">Нахождение в розыске <span class="required">*</span></label>
    <select name="is_wanted" id="is_wanted" class="form-control {{ $errors->has('is_wanted') ? 'is-invalid' : '' }}">
        <option value="0" {{ !$is_wanted ? 'selected' : '' }}>Нет</option>
        <option value="1" {{ $is_wanted ? 'selected' : '' }}>В розыске</option>
    </select>
    <div class="invalid-feedback">{{ $errors->first('is_wanted') }}</div>
</div>
