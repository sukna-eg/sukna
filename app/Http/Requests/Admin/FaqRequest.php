<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
            'question_en' => 'required|min:4|max:1000',
            'question_ar' => 'required|min:4|max:1000',
            'answer_en' => 'required|min:4|max:10000',
            'answer_ar' => 'required|min:4|max:10000',
        ];
    }
    public function attributes(): array
    {
        return [
            'question_en' => 'English Question',
            'question_ar' => 'Arabic Question',
            'answer_en' => 'English Answer',
            'answer_ar' => 'Arabic Answer',
        ];
    }

}
