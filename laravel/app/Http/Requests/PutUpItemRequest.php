<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class PutUpItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->input('seller_id') == Auth::user()->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:50'],
            'image' => ['sometimes', 'nullable', 'bail'],
            'price' => ['bail', 'required', 'numeric', 'digits_between: 0, 8'],
            'text' => ['sometimes', 'nullable', 'bail', 'string', 'max:140'],
            'tags' => ['sometimes', 'nullable', 'bail', 'array', 'distinct'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '入力必須です。',
            'name.string' => '文字列で入力してください。',
            'name.max' => '50文字以内で入力してください。',
            'image.image' => '画像ファイルを選択してください。',
            'price.required' => '入力必須です。',
            'price.numeric' => '数値を入力してください。',
            'price.digits_between' => '8桁までで入力してください。',
            'text.max' => '140文字以内で入力してください。',
            'tags.distinct' => '同じ値を複数選択することはできません。',
        ];
    }

}
