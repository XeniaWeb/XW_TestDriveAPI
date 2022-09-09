<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'nickname' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:drivers,email'],
            'phone' => ['nullable', 'string'],
            'age' => ['required', 'integer', 'between:18,70'],
            'isFree' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation()
    {
        if (key_exists('isFree', $this->all())) {
            $this->merge([
                'is_free' => $this->isFree
            ]);
        }
    }
}
