<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiPostsRequest extends FormRequest
{
    // リダイレクト先
    protected $redirect = '/posts/create';


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
            'title' => 'required|min:3',
            'body' => 'required',
        ];
    }

//    public function messages()
//    {
//        return [
//            'hogeInput.required' => 'ほげ入力は必須項目です。',
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    protected function formatErrors(Validator $validator)
//    {
//        $validator->errors()->add('error_option','hogehoge');
//        return $validator->errors()->all();
//    }
//
//    /**
//     * リダイレクトの処理をカスタマイズするにはここ
//     */
//    public function response(array $errors)
//    {
//        if ($this->ajax() || $this->wantsJson()) {
//            return new JsonResponse($errors, 422);
//        }
//        return $this->redirector->to($this->getRedirectUrl())
//            ->withInput($this->except($this->dontFlash))
//            ->withErrors($errors, $this->errorBag)
//            ->with('hoge_session','session_message');
//    }
}
