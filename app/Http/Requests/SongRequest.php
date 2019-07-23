<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class   SongRequest extends FormRequest
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
            'mp3_file' => 'required|mimes:mpga',
            'image' => 'mimes:jpeg,bmp,png',
            'name' => 'required|min:2|max:50|regex:/^[a-zA-Z0-9][^#&<>\"~;$^%{}?@!]{1,50}$/',
        ];
    }

    public function messages()
    {
        return [
            'mp3_file.mimes' => 'File nhạc không đúng định dạng mp3',
            'mp3_file.required' => 'Bạn chưa thêm file nhạc',
            'image.mimes' => 'File nhạc không đúng định dạng jpg',
            'name.required' => 'Tên bài hát không được để trống',
            'name.min' => 'Tên bài hát không được dưới 2 kí tự',
            'name.max' => 'Tên bài hát không được quá 50 kí tự',
            'name.regex' => 'Tên không đúng định dạng'
        ];
    }
}
