<div>
    <label for="store_id">Dükan <span class="required">{{ $required ? '*' : '' }} </span></label>
    <select {{ $required ? 'required' : '' }} name="store_id" id="store_id"
        class="form-control {{ $errors->has('store_id') ? 'is-invalid' : '' }}">
        <option value="">&nbsp;</option>
        @foreach ($stores as $store)
            <option value="{{ $store->id }}" {{ $store->id == old('store_id', $attrValue) ? 'selected' : '' }}>
                {{ $store->name }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first('store_id') }}</div>
</div>
