<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'name'=>'required|min:4|max:255',
            // 'last_name'=>'required|min:4|max:255',
            // 'email'=>'required|min:5|email|max:255|unique:users,email,'.$this->id,
            'password' => ['required_without:id', 'nullable',Password::min(8)],
            'phone' => 'required|min:9|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone,'.$this->id,
            'type'=>'required|in:0,1',
            'image'=>'required_without:id|mimes:jpg,jpeg,gif,png|max:4000',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'First Name',
            'last_name' => 'Last Name',
        ];
    }
}
