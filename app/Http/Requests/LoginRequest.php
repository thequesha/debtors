<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    protected function prepareForValidation()
    {
        // Clean phone number from mask format
        if ($this->exists('phone')) {
            $phone = preg_replace('/[^0-9]/', '', $this->phone);
            // Remove leading 7 if present
            if (strlen($phone) > 10 && substr($phone, 0, 1) == '7') {
                $phone = substr($phone, 1);
            }
            $this->merge(['phone' => $phone]);
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|string|exists:users,phone',
            'password' => 'required|string|min:8',
        ];
    }
}
