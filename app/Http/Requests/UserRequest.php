<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name"=>"required",
            "email"=>"required|email",
            "password"=>"required|min:8",
            "timezone"=>"required",
            "status"=>"in:1,0",


        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Name can`t be empty',
            "email.required"=>"Email can`t be empty",
            "email.email"=>"Email fomat is invalid",
            "password.required"=>"Password can`t be empty",
            "password.min"=>"Password length should be greater than 8 character",
            "timezone.required"=>"Timezone can`t be empty",
            "status.in"=>"Select Status"
        ];
    }

}
