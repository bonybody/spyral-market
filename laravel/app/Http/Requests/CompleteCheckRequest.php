<?php

namespace App\Http\Requests;

use App\Chat_room;
use App\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompleteCheckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        if (!empty($this->input('sender_id'))) {
            if (Auth::user()->id != $this->input('sender_id')) {
                return false;
            }
        }
        if (Chat_room::find($this->input('id'))) {
            false;
        }

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
        ];
    }
}
