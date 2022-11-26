<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'phone'=>'required|min:2',
        ];
    }
    public function messages()
    {
        return [
            'required' =>':attribute không để trống',
            'min' =>'Nhập ít nhất 2 ký tự',

        ];
    }
    public function attributes()
    {
        return [
            'fullName' => 'Tên',
            'phone' => 'Số điện thoại',
        ];
    }
}
