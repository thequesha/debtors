<div>
    <label for="faq_category_id">FAQ Kategoriýalar</label>
    <select name="faq_category_id" id="faq_category_id"
        class="form-control {{ $errors->has('faq_category_id') ? 'is-invalid' : '' }}">
        <option value="">&nbsp;</option>
        @foreach ($faq_categories as $faq_category)
            <option value="{{ $faq_category->id }}"
                {{ $faq_category->id == old('faq_category_id', $attrValue) ? 'selected' : '' }}>
                {{ $faq_category->name }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">{{ $errors->first('faq_category_id') }}</div>
</div>
