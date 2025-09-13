<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServicesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $serviceId = $this->route('id'); // استخدام 'id' لأنه معرف في Route

        return [
            'name' => [
                'required',
                'string',
                'max:50',
                'min:3',
                Rule::unique('services', 'name')->ignore($serviceId),
            ],
            'description' => 'nullable|string|max:500',
            'price' => 'nullable|numeric|min:0|max:1000000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يرجى إدخال اسم الخدمة.',
            'name.unique' => 'اسم الخدمة موجود مسبقاً، يرجى اختيار اسم آخر.',
            'name.max' => 'اسم الخدمة يجب ألا يزيد عن 50 حرفاً.',
            'name.min' => 'اسم الخدمة يجب أن يكون على الأقل 3 أحرف.',
            'description.max' => 'الوصف لا يمكن أن يتجاوز 500 حرف.',
            'price.numeric' => 'السعر يجب أن يكون رقماً صحيحاً أو عشرياً.',
            'price.min' => 'السعر لا يمكن أن يكون سلبياً.',
            'price.max' => 'السعر كبير جداً.',
        ];
    }
}
