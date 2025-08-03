<div class="pb-3">
    <label for="specification_{{ $specification->id }}">{{ $specification->name }}</label>
    <select name="options[]" id="specification_{{ $specification->id }}" class="form-control">
        <option value="">&nbsp;</option>
        @foreach ($specification->options as $option)
            <option value="{{ $option->id }}"
                {{ $option->id ==$product->options()->where('option_id', $option->id)->exists()? 'selected': '' }}>
                {{ $option->name }}</option>
        @endforeach
    </select>
</div>
