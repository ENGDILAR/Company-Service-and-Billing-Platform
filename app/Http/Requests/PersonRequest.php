<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Name'  => 'required|string|min:3|max:50',
            'email' => 'nullable|email|max:100|unique:people,email',
            'Phone' => 'required|string|regex:/^[0-9]{10,15}$/|unique:people,Phone',
        ];
    }

   public function messages(): array
    {
        return [
            'name.required'  => 'اسم الشخص مطلوب.',
            'name.string'    => 'اسم الشخص يجب أن يكون نصاً.',
            'name.min'       => 'اسم الشخص يجب أن يكون على الأقل 3 أحرف.',
            'name.max'       => 'اسم الشخص يجب ألا يزيد عن 50 حرف.',

            'email.email'    => 'البريد الإلكتروني غير صالح.',
            'email.unique'   => 'البريد الإلكتروني مستخدم بالفعل.',
            'email.max'      => 'البريد الإلكتروني طويل جداً.',

            'Phone.required' => 'رقم الهاتف مطلوب.',
            'Phone.string'   => 'رقم الهاتف يجب أن يكون نصاً من أرقام.',
            'Phone.regex'    => 'رقم الهاتف يجب أن يحتوي على 9 إلى 15 رقم.',
            'Phone.unique'   => 'رقم الهاتف مستخدم بالفعل.',
        ];
    }
}
