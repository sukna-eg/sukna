<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'content'=>'nullable|min:0|max:10000',
            'points'=>'required_without:id|numeric|min:0|max:5',
            'user_id'=>'required_without:id|exists:users,id',
            'partner_id'=>'required_without:id|exists:partners,id',
            'status'=>'required|in:0,1',
        ];
    }
    public function attributes(): array
    {
        return [
            'partner_id' => 'Partner',
            'user_id' => 'User',
        ];
    }
}
