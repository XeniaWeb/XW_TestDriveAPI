<?php

namespace App\Http\Requests\V1;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCarRequest extends FormRequest
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
        $year = now()->year;
        return [
            'brand' => ['required', 'string', 'max:100'],
            'model' => ['nullable', 'string', 'max:255'],
            'ageYear' => ['required', 'integer', 'between:1950,' . $year],
            'isFree' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'age_year' => $this->ageYear
        ]);

        if (key_exists('isFree', $this->all())) {
            $this->merge([
                'is_free' => $this->isFree
            ]);
        }
    }
}
