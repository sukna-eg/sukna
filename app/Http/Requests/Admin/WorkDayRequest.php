<?php

namespace App\Http\Requests\Admin;

use App\Models\Shift;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class WorkDayRequest extends FormRequest
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
            'from'=>'nullable|date_format:H:i',
            'to'=>'nullable|date_format:H:i',
            'status'=>'required_with:id|in:0,1',
        ];
    }
}
