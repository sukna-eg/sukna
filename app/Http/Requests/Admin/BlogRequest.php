<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title_en' => 'required|min:4|max:255',
            'title_ar' => 'required|min:4|max:255',
            'description_en' => 'required|min:4|max:10000',
            'description_ar' => 'required|min:4|max:10000',
            'section_id'=> 'required|exists:sections,id',
            'image'=>'required_without:id|mimes:jpg,jpeg,gif,png|max:1000',
            'slider_status'=>'nullable|in:0,1',
        ];
    }

    public function attributes(): array
    {
        return [
            'title_en' => 'English Title',
            'title_ar' => 'Arabic Title',
            'description_en' => 'English Description',
            'description_ar' => 'Arabic Description',
            'section_id' => 'Section',
        ];
    }
}
