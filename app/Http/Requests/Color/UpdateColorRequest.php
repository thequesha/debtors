<?php

namespace App\Http\Requests\Color;

use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'price'       => ['nullable', 'numeric', 'min:0'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
            'is_active'   => ['nullable', 'boolean'],
            // 'hex_code'    => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'type'        => ['required', 'in:body,interior'],
            'image'       => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'       => 'название',
            'price'      => 'цена',
            'sort_order' => 'порядок сортировки',
            'hex_code'   => 'HEX код',
            'type'       => 'тип',
            'image'      => 'изображение',
        ];
    }
}
