<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreUserRequest extends FormRequest
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
            'fullName'=>'required|min:2',
            'phone'=>'required|min:2|unique:App\Models\User,phone',
            'username'=>'required|unique:App\Models\User,username',
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
            'required' =>':attribute không để trống',
            'min' =>'Nhập ít nhất 2 ký tự',
            'unique'=>":attribute đã tồn tại"
        ];
    }

    public function attributes()
    {
        return [
            'fullName' => 'Tên',
            'username' => 'Tài khoản',
            'phone' => 'Số điện thoại',
        ];
    }
}
