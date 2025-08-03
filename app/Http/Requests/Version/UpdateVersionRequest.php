<?php

namespace App\Http\Requests\Version;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVersionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['sometimes', 'required', 'string', 'max:255'],
            'price'      => ['sometimes', 'required', 'numeric', 'min:0'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'       => 'название',
            'price'      => 'цена',
            'sort_order' => 'порядок сортировки',
            'is_active'  => 'активность',
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('is_active')) {
            $this->merge(['is_active' => false]);
        }
    }
}
