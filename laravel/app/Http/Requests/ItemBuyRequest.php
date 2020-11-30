<?php

namespace App\Http\Requests;

use App\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ItemBuyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Item::find($this->input('item_id'));
        if (Auth::user()->id === $this->input('buyer_id')) {
            return true;
        } elseif(
        ($item->status == 'trade') ||
        ($item->status == 'sold')
        ) {
            return false;
        } else {
            return true;
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
            //
        ];
    }
}
