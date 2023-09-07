<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class billRequest extends FormRequest
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

            'bill_code' => 'required|unique:bills,bill_code,'.$this->id,
            'bill_date'=>'required',
            'due_date'=>'required',
            'section_id'=>'required',
            'product_id'=>'required',
            'mount_collection'=>'required',
            'mount_commission'=>'required',
            'discount'=>'required',
            'discount_rate_id'=>'required',
            'note'=>'required',



        ];
    }
    public function messages()
    {
        return [
            'bill_code.required'=>'الرجاء ادخال كود الفاتورة',
            'bill_code.unique'=>'الفاتورة موجودة من قبل',
            'bill_date.required'=>'الرجاء اخال تارخ الفاتورة',
            'due_date.required'=>'الرجاء ادخال تاريخ الاستحقاق',
            'section_id.required'=>'الرجاء ادخال قسم الفاتورة',
            'product_id.required'=>'الرجاء ادخال منتج او نوع الفاتورة',
            'mount_collection.required'=>'الرجاء ادخال مبلغ التحصيل',
            'mount_commission.required'=>'الرجاء ادخال مبلغ العمولة',
            'discount.required'=>'الرجاء اخال قيمة الخصم',
            'discount_rate_id.required'=>'الرجاء ادخال نسبة الخصم',

        ];
    }
}
