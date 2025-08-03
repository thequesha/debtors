<div>
    <label for="brand_id">Brendi</label>
    <select name="brand_id" id="brand_id" class="form-control {{ $errors->has('brand_id') ? 'is-invalid' : '' }}">
        <option value="">&nbsp;</option>
        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}" {{ $brand->id == old('brand_id', $attrValue) ? 'selected' : '' }}>
                {{ $brand->name }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first('brand_id') }}</div>
</div>
