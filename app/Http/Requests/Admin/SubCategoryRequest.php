<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'name_en' => 'required|min:4|max:255',
            'name_ar' => 'required|min:4|max:255',
            'category_id'=>'required|exists:categories,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'name_en' => 'English Name',
            'name_ar' => 'Arabic Name',
            'category_id' => 'Category',
        ];
    }
}
