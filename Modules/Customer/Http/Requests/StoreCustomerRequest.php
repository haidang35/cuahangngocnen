<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'nullable|email|string',
            'phone' => 'nullable|string',
            'note' => 'nullable|string',
            'address' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên khách hàng không được bỏ trống', 
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
