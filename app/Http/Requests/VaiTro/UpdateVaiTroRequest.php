<?php

namespace App\Http\Requests\VaiTro;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVaiTroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $vaiTroId = $this->route('vai_tro');
        if (is_object($vaiTroId)) {
            $vaiTroId = $vaiTroId->id;
        }

        return [
            'ten_vai_tro' => 'required|string|max:100|unique:vai_tros,ten_vai_tro,' . $vaiTroId,
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
