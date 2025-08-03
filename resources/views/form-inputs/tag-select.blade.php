<div class="pb-2">
    <label for="tags">Teglary <span class="required">*</span></label>
    <select multiple name="tags[]" id="tags" class="form-control {{ $errors->has('tag_id') ? 'is-invalid' : '' }}">
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $attrValue)) ? 'selected' : '' }}>
                {{ $tag->name }}</option>
        @endforeach
    </select>

    <div class="invalid-feedback">{{ $errors->first('tags') }}</div>
</div>
