<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'toAc'=>'exists:App\Models\User,accountNumber',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'messages'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
    public function messages()
    {
        return [
            'exists' =>':attribute không tồn tại trong hệ thống',

        ];
    }

    public function attributes()
    {
        return [
            'toAc' => 'Số tài khoản',

        ];
    }
}
