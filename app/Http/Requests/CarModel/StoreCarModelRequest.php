<?php

namespace App\Http\Requests\CarModel;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'brand_id.required' => 'Поле марки обязательно для заполнения.',
            'brand_id.exists' => 'Выбранная марка не существует.',
            'name.required' => 'Поле названия модели обязательно для заполнения.',
            'name.string' => 'Название модели должно быть строкой.',
            'name.max' => 'Название модели не должно превышать 255 символов.',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'brand_id' => 'марка',
            'name' => 'название модели',
        ];
    }
}
