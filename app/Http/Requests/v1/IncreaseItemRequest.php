<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class IncreaseItemRequest extends FormRequest
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
        return [
            'amount' => ['required', 'integer', 'min:1']
        ];
    }

    protected function prepareForValidation()
    {
        $new_qty = $this->route('item')['quantity'] + $this->amount;

        $this->merge(['quantity' => $new_qty]);
    }
}
