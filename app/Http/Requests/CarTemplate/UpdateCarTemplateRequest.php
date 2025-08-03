<?php

namespace App\Http\Requests\CarTemplate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCarTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $engineEnum       = ['Электро', 'Гибрид последовательный', 'Гибрид параллельный', 'Бензин'];
        $transmissionEnum = ['автомат', 'механика', 'робот', 'вариатор'];

        return [
            'name'       => ['sometimes', 'nullable', 'string', 'max:255'],
            'brand_id'   => ['sometimes', 'required', 'integer', 'exists:brands,id'],
            'model_id'   => ['sometimes', 'required', 'integer', 'exists:car_models,id'],
            'trim_id'    => ['sometimes', 'required', 'integer', 'exists:trims,id'],

            'engine_types'   => ['sometimes', 'nullable', 'array'],
            'engine_types.*' => ['string', Rule::in($engineEnum)],

            'transmissions'   => ['sometimes', 'nullable', 'array'],
            'transmissions.*' => ['string', Rule::in($transmissionEnum)],

            'version_ids'   => ['sometimes', 'nullable', 'array'],
            'version_ids.*' => ['integer', 'exists:versions,id'],

            'exterior_color_ids'   => ['sometimes', 'nullable', 'array'],
            'exterior_color_ids.*' => ['integer', 'exists:colors,id'],

            'exterior_extra_color_ids'   => ['sometimes', 'nullable', 'array'],
            'exterior_extra_color_ids.*' => ['integer', 'exists:colors,id'],

            'interior_color_ids'   => ['sometimes', 'nullable', 'array'],
            'interior_color_ids.*' => ['integer', 'exists:colors,id'],

            'interior_extra_color_ids'   => ['sometimes', 'nullable', 'array'],
            'interior_extra_color_ids.*' => ['integer', 'exists:colors,id'],

            'wheel_ids'   => ['sometimes', 'nullable', 'array'],
            'wheel_ids.*' => ['integer', 'exists:wheels,id'],

            'option_ids'   => ['sometimes', 'nullable', 'array'],
            'option_ids.*' => ['integer', 'exists:options,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'brand_id' => 'марка',
            'model_id' => 'модель',
            'trim_id'  => 'комплектация',
        ];
    }
}
