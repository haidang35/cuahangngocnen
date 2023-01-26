<?php

namespace Modules\Debit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDebitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required',
            'deadline' => 'string|nullable',
            'payment_date' => 'string|nullable',
            'note' => 'string|nullable'
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'Số tiền không được để trống'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
