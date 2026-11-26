<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ho_ten' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:tai_khoans,email',
            'mat_khau' => 'required|string|min:6|confirmed',
            'so_dien_thoai' => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'ho_ten.required' => 'Vui lòng nhập họ và tên.',
            'ho_ten.max' => 'Họ và tên không được vượt quá 100 ký tự.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'email.unique' => 'Email này đã được đăng ký tài khoản.',
            'mat_khau.required' => 'Vui lòng nhập mật khẩu.',
            'mat_khau.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự.',
            'mat_khau.confirmed' => 'Xác nhận mật khẩu không trùng khớp.',
            'so_dien_thoai.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
        ];
    }
}
