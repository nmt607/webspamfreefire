<?php

namespace App\Http\Requests;

use App\Traits\ValidateTrait;
use http\Env\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Cache;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    use ValidateTrait;

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
            'username' => 'required',
            'password' => 'required|min:6'
        ];
    }

//    tesst trc khi validate nhé bạn sơn nhessssss ban oi cutisssss
    public function str_replace_first($search, $replace, $subject)
    {
        $search = '/' . preg_quote($search, '/') . '/';
        return preg_replace($search, $replace, $subject, 1);
    }

    protected function prepareForValidation()
    {
        if (is_numeric(request('username'))) {
            $username_string = strval(request('username'));
            $first_string = substr($username_string, 0, 1);
            if ($first_string == 0) {
                $username_string = $this->str_replace_first('0', '84', $username_string);
                $this->merge([
                    'username' => $username_string,
                ]);
            }
        }
    }


    public function messages()
    {
        return [
            'username.required' => 'Vui lòng điền tài khoản',
            'password.required' => 'Vui lòng điền mật khẩu',
            'password.min' => 'Mật khẩu bạn đã nhập không chính xác'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->validateAccount(request('username')) === false) {
                $validator->errors()->add('username', 'Tài khoản này không tồn tại');
            }
        });

    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $errors = $validator->errors()->first();
            throw new HttpResponseException(
                response()->json(['message' => $errors, 'status' => 400])
            );
        }
        parent::failedValidation($validator);
    }
}
