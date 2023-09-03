<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title_en' => 'required|min:4|max:255',
            'title_ar' => 'required|min:4|max:255',
            'body_en' => 'required|min:4|max:10000',
            'body_ar' => 'required|min:4|max:10000',
            'image'=>'nullable|mimes:jpg,jpeg,gif,png|max:1000',

        ];
    }

    public function attributes(): array
    {
        return [
            'title_en' => 'English Title',
            'title_ar' => 'Arabic Title',
            'body_en' => 'English Body',
            'body_ar' => 'Arabic Body',
        ];
    }
}
