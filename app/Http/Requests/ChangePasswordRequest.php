<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'new-password' => 'required|min:6|different:current-password|same:password-confirmation'
        ];
    }

    public function messages()
    {
        return [
            'new-password.min' => 'Mật khẩu ít nhất 6 kí tự',
            'new-password.different' => 'Mật khẩu mới trùng với mật khẩu cũ',
            'new-password.same' => 'Xác nhận mật mới khẩu không khớp'
        ];
    }
}
