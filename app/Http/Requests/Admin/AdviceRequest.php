<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdviceRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'body_en' => 'required|min:4|max:10000',
            'body_ar' => 'required|min:4|max:10000',
        ];
    }

    public function attributes(): array
    {
        return [

            'body_en' => 'English Body',
            'body_ar' => 'Arabic Body',
        ];
    }
}
