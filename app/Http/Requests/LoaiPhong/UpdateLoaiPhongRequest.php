<?php

namespace App\Http\Requests\LoaiPhong;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoaiPhongRequest extends FormRequest
{
    /**
     * Xác thực quyền thực thi request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Quy tắc kiểm thực dữ liệu khi cập nhật loại phòng.
     */
    public function rules(): array
    {
        return [
            'ten_loai_phong' => 'required|string|max:255',
            'gia_mac_dinh' => 'required|numeric|min:0',
            'so_nguoi_toi_da' => 'required|integer|min:1',
            'mo_ta' => 'nullable|string',
        ];
    }

    /**
     * Thông báo lỗi tùy chỉnh tiếng Việt.
     */
    public function messages(): array
    {
        return [
            'ten_loai_phong.required' => 'Vui lòng nhập tên loại phòng.',
            'ten_loai_phong.max' => 'Tên loại phòng không được vượt quá 255 ký tự.',
            'gia_mac_dinh.required' => 'Vui lòng nhập đơn giá mặc định.',
            'gia_mac_dinh.numeric' => 'Đơn giá phải là số hợp lệ.',
            'gia_mac_dinh.min' => 'Đơn giá không được nhỏ hơn 0.',
            'so_nguoi_toi_da.required' => 'Vui lòng nhập sức chứa tối đa.',
            'so_nguoi_toi_da.integer' => 'Sức chứa tối đa phải là số nguyên.',
            'so_nguoi_toi_da.min' => 'Sức chứa tối đa phải ít nhất 1 người.',
        ];
    }
}
