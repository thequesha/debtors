<?php

namespace App\Http\Requests\Trim;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrimRequest extends FormRequest
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
            'model_id' => 'required|exists:car_models,id',
            'name' => 'required|string|max:255',
            'battery_capacity' => 'nullable|integer|min:1',
            'power' => 'nullable|integer|min:1',
            'drive_type' => 'nullable|string|in:FWD,RWD,AWD',
            'base_price' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'model_id.required' => 'Поле модели автомобиля обязательно для заполнения.',
            'model_id.exists' => 'Выбранная модель автомобиля не существует.',
            'name.required' => 'Поле названия комплектации обязательно для заполнения.',
            'name.string' => 'Название комплектации должно быть строкой.',
            'name.max' => 'Название комплектации не должно превышать 255 символов.',
            'battery_capacity.integer' => 'Емкость батареи должна быть целым числом.',
            'battery_capacity.min' => 'Емкость батареи должна быть больше 0.',
            'power.integer' => 'Мощность должна быть целым числом.',
            'power.min' => 'Мощность должна быть больше 0.',
            'drive_type.string' => 'Тип привода должен быть строкой.',
            'drive_type.in' => 'Тип привода должен быть одним из: FWD, RWD, AWD.',
            'base_price.required' => 'Поле базовой цены обязательно для заполнения.',
            'base_price.numeric' => 'Базовая цена должна быть числом.',
            'base_price.min' => 'Базовая цена не может быть отрицательной.',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'model_id' => 'модель автомобиля',
            'name' => 'название комплектации',
            'battery_capacity' => 'емкость батареи',
            'power' => 'мощность',
            'drive_type' => 'тип привода',
            'base_price' => 'базовая цена',
        ];
    }
}
