<div class="pb-2">
    <label for="categories">Kategoriýasy <span class="required">*</span></label>
    <select multiple name="categories[]" id="categories" required
        class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ in_array($category->id, old('categories', $attrValue)) ? 'selected' : '' }}>
                {{ $category->ancestor_names }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first('categories') }}</div>
</div>
