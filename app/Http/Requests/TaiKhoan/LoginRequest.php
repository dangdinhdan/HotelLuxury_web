<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'mat_khau' => 'required|string',
            'remember' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email đăng nhập.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'mat_khau.required' => 'Vui lòng nhập mật khẩu.',
        ];
    }
}
