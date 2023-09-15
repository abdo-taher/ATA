<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'same:confirm-password',

        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'يرجي ادخال الاسم',
            'email.required'=>'يرجي ادخال البريد الاليكتروني',
            'email.email'=>'هذا ليس بريد',
            'email.unique'=>'البريد موجود من قيل',
            'password.required'=>'ادخل كلمة المرور',
            'role_name.required'=>'الرجاء ادخال صلاحية المستخدم',
        ];
    }
}
