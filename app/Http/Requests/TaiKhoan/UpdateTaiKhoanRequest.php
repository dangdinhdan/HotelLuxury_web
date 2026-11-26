<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTaiKhoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('id') ?? Auth::id();

        return [
            'ho_ten' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:tai_khoans,email,' . $userId,
            'so_dien_thoai' => 'nullable|string|max:20',
            'dia_chi' => 'nullable|string|max:255',
            'vai_tro_id' => 'nullable|exists:vai_tros,id',
            'trang_thai' => 'nullable|string|in:hoat_dong,khoa',
        ];
    }

    public function messages(): array
    {
        return [
            'ho_ten.required' => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng bởi tài khoản khác.',
            'vai_tro_id.exists' => 'Vai trò được chọn không hợp lệ.',
            'trang_thai.in' => 'Trạng thái tài khoản không hợp lệ.',
        ];
    }
}
