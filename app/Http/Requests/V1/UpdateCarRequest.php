<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
        $year = now()->year;
        if ($method == 'PUT') {
            return [
                'brand' => ['required', 'string', 'max:100'],
                'model' => ['nullable', 'string', 'max:255'],
                'ageYear' => ['required', 'integer', 'between:1950,' . $year],
                'isFree' => ['sometimes', 'boolean'],
            ];
        } else {
            return [
                'brand' => ['sometimes', 'required', 'string', 'max:100'],
                'model' => ['sometimes', 'required', 'string', 'max:255'],
                'ageYear' => ['sometimes', 'required', 'integer', 'between:1950,' . $year],
                'isFree' => ['sometimes', 'boolean'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if (key_exists('ageYear', $this->all())) {
            $this->merge([
                'age_year' => $this->ageYear
            ]);
        }

        if (key_exists('isFree', $this->all())) {
            $this->merge([
                'is_free' => $this->isFree
            ]);
        }
    }
}
