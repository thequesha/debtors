<div>
    <label for="unit_id">Ölçeg birligi <span class="required">{{ $required ? '*' : '' }} </span></label>
    <select {{ $required ? 'required' : '' }} name="unit_id" id="unit_id"
        class="form-control {{ $errors->has('unit_id') ? 'is-invalid' : '' }}">
        <option value="">&nbsp;</option>
        @foreach ($units as $unit)
            <option value="{{ $unit->id }}" {{ $unit->id == old('unit_id', $attrValue) ? 'selected' : '' }}>
                {{ $unit->name }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first('unit_id') }}</div>
</div>
