<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/15/16
 * Time: 4:50 PM
 */

namespace App\Http\Requests;


class PropertyDetailRequest extends Request
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
            'main_selling_line' => 'required',
        ];
    }
}