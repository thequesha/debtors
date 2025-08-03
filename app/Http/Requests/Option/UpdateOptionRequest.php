<?php

namespace App\Http\Requests\Option;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'base_price' => ['nullable', 'numeric', 'min:0'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
            'image'      => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'       => 'название',
            'base_price' => 'цена',
            'sort_order' => 'порядок сортировки',
            'is_active'  => 'активность',
            'image'      => 'изображение',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Checkbox sends value only when checked; default to false when missing.
        $this->merge([
            'is_active' => $this->boolean('is_active', false),
        ]);
    }
}
