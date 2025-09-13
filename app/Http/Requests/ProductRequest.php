<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // يجب أن يكون true للسماح بالتحقق من البيانات
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      $productId = $this->route('id') ?? null; // إذا التعديل، نتجاهل الـ id الحالي

    return [
        'name' => 'required|string|max:255|unique:products,name' . ($productId ? ',' . $productId : ''),
        'price' => 'nullable|numeric|min:0|max:100000',
        'description' => 'nullable|string',
        'ImagePath' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];
    }

    public function messages()
{
    return [
        'name.required' => 'حقل الاسم مطلوب.',
        'name.unique' => 'هذا الاسم موجود مسبقاً. الرجاء اختيار اسم آخر.',
        'price.numeric' => 'يجب أن يكون السعر رقماً.',
        'price.min'=>'يجب ان يكون السعر على الاقل 0',
        'price.max'=>'يجب ان يكون السعر على الاكثر 100000',
        'ImagePath.image' => 'الملف يجب أن يكون صورة.',
        'ImagePath.mimes' => 'أنواع الصور المسموح بها: jpeg, png, jpg, gif, svg.',
        'ImagePath.max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميغابايت.',
    ];
}
}
