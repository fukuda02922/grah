<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
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
            //
            'mail_ad' => 'required|max:40',
            'password' => 'required|max:15'
        ];
    }

    public function messages()
    {
        return [
            'mail_ad.required' => 'メールアドレスが未入力です。',
            'mail_ad.max:40' => 'メールアドレスが不正です。',
            'password.required' => 'パスワードが未入力です。',
            'password.max:15' => 'パスワードが不正です。',
        ];
    }
}
