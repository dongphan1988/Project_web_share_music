<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:3|max:50|regex:/^[a-zA-Z0-9][^#&<>\"~;$^%{}?@!]{1,50}$/',
        ];
    }

    public function messages()
    {
        return [
          'name.required' => 'Tên không được để trống',
          'name.min' => 'Tên không ngắn hơn 3 ký tự',
          'name.max' => 'Tên không  dài quá 50 ký tự',
          'name.regex' => 'Tên không được chứa ký tự đặc biệt',
        ];
    }
}
