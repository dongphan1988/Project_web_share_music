<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongResquestUpdate extends FormRequest
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
            'mp3_file' => 'mimes:mpga',
            'image' => 'mimes:jpeg,bmp,png',
            'name' => 'required|min:3|max:50',
        ];
    }

    public function messages()
    {
        return [
            'mp3_file.mimes' => 'file nhạc không đúng định dạng mp3',
            'mp3_file.required' => 'bạn chưa thêm file nhạc',
            'image.mimes' => 'file nhạc không đúng định dạng jpg',
            'name.required' => 'tên bài hát không được để trống',
            'name.min' => 'tên bài hát không được dưới 3 kí tự',
            'name.max' => 'tên bài hát không được quá 50 kí tự',
        ];
    }
}
