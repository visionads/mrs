<?php

namespace App\Http\Requests;

class MarketingMaterialRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'status' => 'required',
            'mktg_material_id' => 'required',
            'title' => 'required',

        ];
    }
}