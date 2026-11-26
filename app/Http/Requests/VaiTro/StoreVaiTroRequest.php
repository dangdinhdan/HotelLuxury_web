<?php

namespace App\Http\Requests\VaiTro;

use Illuminate\Foundation\Http\FormRequest;

class StoreVaiTroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ten_vai_tro' => 'required|string|max:100|unique:vai_tros,ten_vai_tro',
        ];
    }

    public function messages(): array
    {
        return [
            'ten_vai_tro.required' => 'Vui lòng nhập tên vai trò.',
            'ten_vai_tro.max' => 'Tên vai trò không được vượt quá 100 ký tự.',
            'ten_vai_tro.unique' => 'Tên vai trò này đã tồn tại trong hệ thống.',
        ];
    }
}
