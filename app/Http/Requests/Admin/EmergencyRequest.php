<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmergencyRequest extends FormRequest
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
            'agency_en' => 'required|min:4|max:255',
            'agency_ar' => 'required|min:4|max:255',
            'phone' => 'required|min:9|regex:/^([0-9\s\-\+\(\)]*)$/|unique:helps,phone,'.$this->id,
            'whatsapp' => 'required|min:9|regex:/^([0-9\s\-\+\(\)]*)$/|unique:helps,whatsapp,'.$this->id,
            'logo'=>'required_without:id|mimes:jpg,jpeg,gif,png|max:4000',

        ];
    }

    public function attributes(): array
    {
        return [

            'agency_en' => 'English Agency',
            'agency_ar' => 'Arabic Agency',
        ];
    }
}
