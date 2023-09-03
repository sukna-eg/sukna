<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
        if ($this->has('multi_language')) {
            return [
                'title_en' => 'required|min:4|max:255',
                'title_ar' => 'required|min:4|max:255',
                'title_fr' => 'required|min:4|max:255',
                'title_es' => 'required|min:4|max:255',
                'title_ru' => 'required|min:4|max:255',
                'body_en' => 'required|min:4|max:10000',
                'body_ar' => 'required|min:4|max:10000',
                'body_fr' => 'required|min:4|max:10000',
                'body_es' => 'required|min:4|max:10000',
                'body_ru' => 'required|min:4|max:10000',
            ];
        } else if($this->has('single_language')){
            return [
                'title' => 'required|min:4|max:255',
                'body' => 'required|min:4|max:10000',
            ];
        }


    }
    public function attributes(): array
    {
        return [
            'title_en' => 'English Title',
            'title_ar' => 'Arabic Title',
            'title_fr' => 'Frenh Title',
            'title_ar' => 'Spanish Title',
            'title_ar' => 'Korean Title',
            'body_en' => 'English Body',
            'body_ar' => 'Arabic Body',
            'body_fr' => 'Frenh Body',
            'body_es' => 'Spanish Body',
            'body_ko' => 'Korean Body',
        ];
    }
}
