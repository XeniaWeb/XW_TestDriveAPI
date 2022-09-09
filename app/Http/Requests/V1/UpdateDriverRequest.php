<?php

namespace App\Http\Requests\V1;

use App\Models\Driver;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDriverRequest extends FormRequest
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
                'name' => ['required', 'string', 'max:100'],
                'nickname' => ['nullable', 'string', 'max:100'],
                'email' => ['required', Rule::unique('drivers', 'email')->ignore($this->driver->id)],
                'phone' => ['nullable', 'string'],
                'age' => ['required', 'integer', 'between:18,70'],
                'isFree' => ['sometimes', 'boolean'],
            ];
        } else {
            return [
                'name' => ['sometimes', 'required', 'string', 'max:100'],
                'nickname' => ['sometimes', 'nullable', 'string', 'max:100'],
                'email' => ['sometimes', 'required', Rule::unique('drivers', 'email')->ignore($this->driver->id)],
                'phone' => ['sometimes', 'nullable', 'string'],
                'age' => ['sometimes', 'required', 'integer', 'between:18,70'],
                'isFree' => ['sometimes', 'boolean'],
            ];
        }
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
