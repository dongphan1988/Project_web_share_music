<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SingerRequest extends FormRequest
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
            'name' => 'required|unique:singers,name|min:2|max:20|regex:/^[a-zA-Z][^#&<>\"~;$^%{}?@!]{1,20}$/'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên ca sĩ không được để trống',
            'name.unique' => 'Tên ca sĩ này đã tồn tại',
            'name.min' => 'Tên nhập ít nhất 2 kí tự',
            'name.max' => 'Tên không dài quá 20 kí tự',
            'name.regex' => 'Tên sai định dạng'
        ];
    }
}
