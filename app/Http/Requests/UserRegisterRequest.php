<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use App\Heplers\Helpers;
class UserRegisterRequest extends FormRequest
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
            "first_name"=>"required",
            "last_name"=>"required",
            "email"=>"required|email|",
            "password"=>"required|min:8",
            "username"=>"required",
            "department"=>"required",
            "dob"=>"required",
            "phone"=>"required",
            "timezone"=>"required",
            "loginip"=>"required",
        ];
    }

    public function failedValidation(Validator $validation){

    }
}
