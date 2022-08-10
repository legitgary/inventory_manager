<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Store;
use App\Models\Item;

class UpdateItemRequest extends FormRequest
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
        /** @var $store_id needs to be the supplied store_id or, if it's not defined, the saved store_id */
        $store_id = $this->storeId ?? $this->route('item')['store_id'];

        /* storeId must match an existing store_id
         * itemCode must be unique per store
         * the itemCode uniqueness checker needs to ignore itself to prevent a false red-flag
         */
        if ($this->method() == 'PUT') {
            return [
                'storeId' => ['required', 'exists:stores,id'],
                'fullName' => ['required'],
                'itemCode' => ['required', 
                    Rule::unique('items', 'item_code')->ignore($this->route('item')['id'])->where(function ($query) use ($store_id) {
                        return $query->where('store_id', $store_id);
                    })],
                'quantity' => ['required'],
                'purchasePrice' => ['required'],
                'markup' => ['required']
            ];
        } else {
            return [
                'storeId' => ['sometimes', 'required', 'exists:stores,id'],
                'fullName' => ['sometimes', 'required'],
                'itemCode' => ['sometimes', 'required', 
                    Rule::unique('items', 'item_code')->ignore($this->route('item')['id'])->where(function ($query) use ($store_id) {
                        return $query->where('store_id', $store_id);
                    })],
                'quantity' => ['sometimes', 'required'],
                'purchasePrice' => ['sometimes', 'required'],
                'markup' => ['sometimes', 'required']
            ];
        }
    }

    public function messages()
    {
        /** @var $store_id needs to be the supplied store_id or, if it's not defined, the saved store_id */
        $this_store_id = $this->storeId ?? $this->route('item')['store_id'];

        return [
            'itemCode.unique' => "The item code (id: " . $this->route('item')['id'] . ") already exists for this store (id: " . $this_store_id . ")"
        ];
    }

    protected function prepareForValidation()
    {
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
