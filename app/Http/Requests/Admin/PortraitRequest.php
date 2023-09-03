<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PortraitRequest extends FormRequest
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
            'images'=>'required_without:id|array|min:1',
            'images.*'=>'required_without:id|mimes:jpg,jpeg,gif,png|max:1000',
            'image'=>'required_with:id|mimes:jpg,jpeg,gif,png|max:1000',
            'partner_id'=>'required|exists:partners,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'partner_id' => 'Partner',
        ];
    }
}
