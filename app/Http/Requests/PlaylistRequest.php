<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaylistRequest extends FormRequest
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
            'name'=>'required|regex:/^[a-zA-Z0-9][^#&<>\"~;$^%{}?@!]{1,30}$/'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'không được để trống tên playlist',
            'name.regex'=>'Tên playlist không được chứa kí tự đặc biệt'
        ];
    }
}
