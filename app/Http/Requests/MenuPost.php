<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuPost extends FormRequest
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
            'name' => 'required',
            'name_ne' => 'required',
            'image_name' => '',
            'priority_no' => '',
            'menu_type' => 'required',
            'page_url' => '',
            'page_url_ne' => '',
            'status' => 'required',
            'side_menu_category' => '',
            'url_type' => '',
        ];
    }
}
