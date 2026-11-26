<?php

namespace App\Http\Requests\Phong;

use Illuminate\Foundation\Http\FormRequest;

class StorePhongRequest extends FormRequest
{
    /**
     * Xác thực quyền thực thi request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Quy tắc kiểm thực dữ liệu khi tạo buồng phòng mới.
     */
    public function rules(): array
    {
        return [
            'so_phong' => 'required|string|max:50|unique:phongs,so_phong',
            'loai_phong_id' => 'required|exists:loai_phongs,id',
            'gia_moi_dem' => 'required|numeric|min:0',
            'suc_chua_toi_da' => 'required|integer|min:1',
            'dien_tich' => 'nullable|numeric|min:0',
            'tang' => 'required|integer|min:1',
            'mo_ta' => 'nullable|string',
            'trang_thai' => 'required|in:trong,dang_o,dang_don,bao_tri',
            'hinh_anh_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'hinh_anh_url' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Thông báo lỗi tùy chỉnh tiếng Việt.
     */
    public function messages(): array
    {
        return [
            'so_phong.required' => 'Vui lòng nhập số hiệu phòng.',
            'so_phong.unique' => 'Số phòng này đã tồn tại trong hệ thống.',
            'loai_phong_id.required' => 'Vui lòng chọn loại phòng.',
            'loai_phong_id.exists' => 'Loại phòng được chọn không tồn tại.',
            'gia_moi_dem.required' => 'Vui lòng nhập đơn giá mỗi đêm.',
            'gia_moi_dem.numeric' => 'Đơn giá mỗi đêm phải là số hợp lệ.',
            'gia_moi_dem.min' => 'Đơn giá không được nhỏ hơn 0.',
            'suc_chua_toi_da.required' => 'Vui lòng nhập sức chứa tối đa.',
            'suc_chua_toi_da.min' => 'Sức chứa tối đa phải ít nhất 1 người.',
            'tang.required' => 'Vui lòng nhập tầng của phòng.',
            'tang.min' => 'Tầng phải lớn hơn hoặc bằng 1.',
            'trang_thai.required' => 'Vui lòng chọn trạng thái vận hành.',
            'trang_thai.in' => 'Trạng thái vận hành không hợp lệ.',
            'hinh_anh_files.*.image' => 'Tệp tải lên phải là hình ảnh.',
            'hinh_anh_files.*.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc webp.',
            'hinh_anh_files.*.max' => 'Dung lượng mỗi ảnh không được vượt quá 5MB.',
        ];
    }
}
