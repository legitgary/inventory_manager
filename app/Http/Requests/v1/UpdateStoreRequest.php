<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStoreRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'name' => ['required', Rule::unique('stores', 'name')->ignore($this->route('store')['id'])]
            ];
        } else {
            return [
                'name' => ['sometimes', 'required', Rule::unique('stores', 'name')->ignore($this->route('store')['id'])]
            ];
        }

    }
}
