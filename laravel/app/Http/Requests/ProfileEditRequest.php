<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->input('id') == Auth::user()->id) {
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
            'image' => ['sometimes', 'bail', 'image'],
            'name' => ['bail', 'required', 'string', 'max:8'],
            'subject' => ['sometimes', 'bail', 'array', 'distinct'],
            'message' => ['sometimes', 'nullable', 'bail', 'string', 'max:140'],
        ];
    }

    public function messages()
    {
        return [
            'image.file' => 'ファイル形式で投稿してください。',
            'image.image' => '画像ファイルで投稿してください。',
            'name.required' => '入力必須です。',
            'name.string' => '文字列を入力してください。',
            'name.max' => '8文字以内で入力してください。',
            'subject.array' => '入力方法が不適切です。',
            'subject.distinct' => '同じ項目を複数選択することはできません。',
            'message.string' => '文字列を入力してください。',
            'message.max' => '140文字以内で入力してください。',
        ];
    }
}
