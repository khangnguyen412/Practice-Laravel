<?php

namespace App\Http\Requests\Lecture23;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as Validation;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestRegister extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username'  => 'required|min:6|max:50',
            'password'  => 'required|min:6|max:50',
            'email'     => 'required|email',
        ];
    }

    /**
     *  Thông báo lỗi
     */
    public function messages()
    {
        return [
            'require'   => ':attributes không được để trống',
            'min'       => ':attributes không được ít hơn 6 kí tự',
            'max'       => ':attributes không được quá 50 kí tự'
        ];
    }

    /**
     *  Thuộc tính
     */
    public function attributes()
    {
        return [
            'username'  => 'Tên đăng nhập',
            'password'  => 'Mật khẩu',
            'email'     => 'Email',
        ];
    }

    protected function failedValidation(Validation $validator) {
        $valid_result = [
            'status'  => 'error',
            'message' => 'Validation failed',
            'errors'  => $validator->errors()
        ];
        // Nếu là API, trả về JSON với cấu trúc lỗi tùy chỉnh:
        throw new HttpResponseException(response()->json($valid_result, 422, [], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    }
}
