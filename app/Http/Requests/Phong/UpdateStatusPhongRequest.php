<?php

namespace App\Http\Requests\Phong;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusPhongRequest extends FormRequest
{
    /**
     * Xác thực quyền thực thi request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Quy tắc cập nhật nhanh trạng thái buồng phòng.
     */
    public function rules(): array
    {
        return [
            'trang_thai' => 'required|in:trong,dang_o,dang_don,bao_tri',
        ];
    }

    /**
     * Thông báo lỗi tùy chỉnh tiếng Việt.
     */
    public function messages(): array
    {
        return [
            'trang_thai.required' => 'Vui lòng chọn trạng thái vận hành.',
            'trang_thai.in' => 'Trạng thái vận hành không hợp lệ.',
        ];
    }
}
