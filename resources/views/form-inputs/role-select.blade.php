<div class="pb-3">
    <label for="roles">Должность <span class="required">*</span></label>
    <select multiple name="roles[]" id="roles" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}">
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', $attrValue)) ? 'selected' : '' }}>
                {{ $role->name }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first('roles') }}</div>
</div>
