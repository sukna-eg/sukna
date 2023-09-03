<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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

        ];
    }

    public function attributes(): array
    {
        return [
            'title_one_en' => 'English Title',
            'title_one_ar' => 'Arabic Title',
            'title_two_en' => 'English Second Title',
            'title_two_ar' => 'Arabic Second Title',
            'name_en' => 'English Name',
            'name_ar' => 'Arabic Name',
            'area_name_en' => 'English Area Name',
            'area_name_ar' => 'Arabic Area Name',
        ];
    }
}
