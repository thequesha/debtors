<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->addExtension('base64_image', function ($attribute, $value, $parameters, $validator) {
            if (empty($value)) {
                return false;
            }

            // Check if the string starts with "data:image"
            if (!str_starts_with($value, 'data:image')) {
                return false;
            }

            // Extract the base64 data
            $data = explode(',', $value);
            if (count($data) !== 2) {
                return false;
            }

            // Check if it's a valid base64 string
            if (!base64_decode($data[1], true)) {
                return false;
            }

            // Check if it's a valid image
            $imageData = base64_decode($data[1]);
            $f = finfo_open();
            $mimeType = finfo_buffer($f, $imageData, FILEINFO_MIME_TYPE);
            finfo_close($f);

            return in_array($mimeType, ['image/jpeg', 'image/png']);
        });

        $validator->addExtension('phone_mask', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\+7 [0-9]{3} [0-9]{7}$/', $value);
        });
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'base64_image' => 'Поле :attribute должно быть валидным изображением в формате JPEG или PNG.',
            'phone_mask' => 'Поле :attribute должно быть в формате: +7 777 7777777',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:150',
                // 'regex:/^[a-zA-Z\s\.-]+$/',
            ],
            'surname' => [
                'required',
                'string',
                'max:150',
                // 'regex:/^[a-zA-Z\s\.-]+$/',
            ],
            'middle_name' => [
                'nullable',
                'string',
                'max:150',
                // 'regex:/^[a-zA-Z\s\.-]+$/',
            ],

            'birth_date' => [
                'nullable',
                'date_format:d-m-Y',
                'before:today'
            ],

            'status' => 'required|in:fired,active',


            'roles' => 'required|array',
            'roles.*' => 'required|integer|exists:roles,id',
        ];

        if ($this->isMethod('post')) {
            $rules['phone'] = [
                'required',
                'string',
                'phone_mask',
                'unique:users,phone',
            ];
            $rules['image'] = [
                'nullable',
                'string',
                'base64_image',
            ];
            $rules['password'] = [
                'required',
                'string',
                'min:8',
                'max:50',
                'regex:/^[a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)\_\+\-\=\{\}\:\;\"\'\<\>\,\.\?\/\|\\\\]+$/',
            ];
        } else {
            $rules['phone'] = [
                'nullable',
                'string',
                'phone_mask',
                'unique:users,phone,' . $this->user->id,
            ];
            $rules['image'] = [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if (!$value) {
                        return;
                    }

                    // Skip validation for existing image URLs
                    if (!str_starts_with($value, 'data:image')) {
                        return;
                    }

                    // Validate base64 image format
                    if (!preg_match('/^data:image\/(jpeg|png);base64,/', $value)) {
                        $fail('Формат изображения должен быть JPEG или PNG.');
                    }
                },
            ];
        }

        return $rules;
    }
}
