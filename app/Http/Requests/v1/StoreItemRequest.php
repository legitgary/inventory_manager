<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Store;

class StoreItemRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        /*
         * storeId must match an existing store_id
         * itemCode must be unique per store
         */
        return [
            'storeId' => ['required', 'exists:stores,id'],
            'fullName' => ['required'],
            'itemCode' => ['required', 
                Rule::unique('items', 'item_code')->where(function ($query) {
                    return $query->where('store_id', $this->storeId);
                })],
            'quantity' => ['required'],
            'purchasePrice' => ['required'],
            'markup' => ['required']
        ];
    }

    protected function prepareForValidation() {
        if ($this->storeId) {
            $this->merge(['store_id' => $this->storeId]);
        }
        if ($this->fullName) {
            $this->merge(['full_name' => $this->fullName]);
        }
        if ($this->itemCode) {
            $this->merge(['item_code' => $this->itemCode]);
        }
        if ($this->purchasePrice) {
            $this->merge(['purchase_price' => $this->purchasePrice]);
        }
    }
}
