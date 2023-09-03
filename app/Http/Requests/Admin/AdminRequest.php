<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name'=>'required|min:4|max:255',
            'email'=>'required|min:5|email|max:255|email|unique:admins,email,'.$this->id,
            'password' => ['required_without:id', 'nullable',Password::min(8)],
        ];
    }
    public function attributes(): array
    {
        return [
            'role_id' => 'Role',
        ];
    }
}
