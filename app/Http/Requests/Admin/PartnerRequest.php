<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


class PartnerRequest extends FormRequest
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
            'address_en' => 'required|min:4|max:255',
            'address_ar' => 'required|min:4|max:255',
            // 'branch_name_en' => 'required_without:id|min:4|max:255',
            // 'branch_name_ar' => 'required_without:id|min:4|max:255',
            'description_en' => 'required|min:4|max:10000',
            'description_ar' => 'required|min:4|max:10000',
            // 'logo'=>'required_without:id|mimes:jpg,jpeg,gif,png|max:4000',
            // 'file'=>'mimes:jpg,gif,jpeg,png,mp4,pdf,txt,mkv,flv,docs,doc,3gb,xlsx,pptx|max:4000',
            // 'phone' => 'required|min:9|regex:/^([0-9\s\-\+\(\)]*)$/',
            // 'whatsapp' => 'required|min:9|regex:/^([0-9\s\-\+\(\)]*)$/',
            // 'start_status'=>'nullable|in:0,1',
            // 'status'=>'nullable|in:0,1',
            // 'start_price' => 'required|numeric',
            // 'price_rate' => 'required|integer|min:1|max:5',
            'video_url'=>'nullable|min:4|max:500|url',
            'music_url'=>'nullable|min:4|max:500|url',
            // 'subcategories'=>'array|min:1',
            // 'subcategories.*'=>'required|exists:subcategories,id',
            'portraits'=>'required_without:id|array|min:1',
            // 'portraits.*'=>'required_without:id|mimes:jpg,jpeg,gif,png|max:1000',
            // 'landscapes'=>'required_without:id|array|min:1',
            // 'landscapes.*'=>'required_without:id|mimes:jpg,jpeg,gif,png|max:1000',
            // 'area_id'=>'required_without:id|exists:areas,id',
            // 'lat'=>'required_without:id|numeric',
            // 'long'=>'required_without:id|numeric',
            // 'location'=>'required_without:id|min:4|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'name_en' => 'English Name',
            'name_ar' => 'Arabic Name',
            'branch_name_en' => 'Branch English Name',
            'branch_name_ar' => 'Branch Arabic Name',
            'description_en' => 'English Description',
            'description_ar' => 'Arabic Description',
            'area_id'=>"Area",
        ];
    }
}
