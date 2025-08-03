<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Check if user can manage cars (similar to user management)
        return $this->user()->can('manage users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:car_models,id',
            'trim_id' => 'required|exists:trims,id',
            'body_color_id' => 'required|exists:colors,id',
            'interior_color_id' => 'nullable|exists:colors,id',
            'wheel_id' => 'nullable|exists:wheels,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'engine_type' => 'required|string|max:255',
            'body_type' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'drive' => 'required|string|max:255',
            'steering_wheel' => 'required|string|max:255',
            'seats' => 'required|integer|min:1|max:10',
            'status' => 'required|string|max:255',
            'invoice' => 'required|numeric|min:0',
            'bank_percent' => 'nullable|numeric|min:0|max:100',
            'delivery_insurance' => 'nullable|numeric|min:0',
            'customs_clearance' => 'nullable|numeric|min:0',
            'recycling_fee' => 'nullable|numeric|min:0',
            'service_fee' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'nullable|integer',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'brand_id' => 'Марка авто',
            'model_id' => 'Модель авто',
            'trim_id' => 'Комплектация',
            'body_color_id' => 'Цвет авто',
            'interior_color_id' => 'Цвет салона',
            'wheel_id' => 'Колеса',
            'year' => 'Год выпуска',
            'engine_type' => 'Тип двигателя',
            'body_type' => 'Тип кузова',
            'transmission' => 'Трансмиссия',
            'drive' => 'Привод',
            'steering_wheel' => 'Руль',
            'seats' => 'Количество мест',
            'status' => 'Статус',
            'invoice' => 'Инвойс',
            'bank_percent' => '% банка',
            'delivery_insurance' => 'Стоимость доставки + страховка',
            'customs_clearance' => 'Таможенное оформление',
            'recycling_fee' => 'Утильсбор',
            'service_fee' => 'Комиссия за предоставление услуг',
            'images' => 'Фото автомобиля',
            'images.*' => 'Фото автомобиля',
            'deleted_images' => 'Удаленные фото',
            'deleted_images.*' => 'Удаленное фото',
        ];
    }
}
