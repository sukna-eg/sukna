<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class IntroductionRequest extends FormRequest
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
            'image_number'=>'required:id|integer|min:1|max:10',
            'title_one_en' => 'required|min:4|max:255',
            'title_one_ar' => 'required|min:4|max:255',
            'title_two_en' => 'required|min:4|max:255',
            'title_two_ar' => 'required|min:4|max:255',
            'body_en' => 'required|min:4|max:10000',
            'body_ar' => 'required|min:4|max:10000',
        ];
    }

    public function attributes(): array
    {
        return [
            'title_one_en' => 'English Title',
            'title_one_ar' => 'Arabic Title',
            'title_two_en' => 'English Second Title',
            'title_two_ar' => 'Arabic Second Title',
            'body_en' => 'English Body',
            'body_ar' => 'Arabic Body',
            'image_number' => 'Image Number',
        ];
    }
}
