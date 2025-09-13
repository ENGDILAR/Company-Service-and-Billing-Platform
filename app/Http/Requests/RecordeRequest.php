<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // تحقق من اسم الجدول
            'table_name' => 'required|string|min:3|max:50',

            // تحقق من الأسطر القديمة والجديدة
            'rows' => 'required|array|min:1',
            'rows.*.statement' => 'sometimes|required|string|min:3|max:255',
            'rows.*.credit'    => 'sometimes|required|numeric|min:0',
            'rows.*.debit'     => 'sometimes|required|numeric|min:0',
            'rows.*.details'   => 'nullable|string|max:500',
        ];
    }
  public function messages(): array
    {
        return [
            'table_name.required' => 'اسم الجدول مطلوب.',
            'table_name.string'   => 'اسم الجدول يجب أن يكون نصاً.',
            'table_name.min'      => 'اسم الجدول يجب أن يكون على الأقل 3 أحرف.',
            'table_name.max'      => 'اسم الجدول يجب ألا يتجاوز 50 حرفاً.',

            'rows.required' => 'يجب إضافة سطر واحد على الأقل.',
            'rows.*.statement.required' => 'حقل البيان مطلوب لكل سطر.',
            'rows.*.credit.required'    => 'حقل "له" مطلوب لكل سطر.',
            'rows.*.debit.required'     => 'حقل "عليه" مطلوب لكل سطر.',
        ];
    }

}
