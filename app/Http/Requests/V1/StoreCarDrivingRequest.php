<?php

namespace App\Http\Requests\V1;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCarDrivingRequest extends FormRequest
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
        $drivers = Driver::query()->get()->pluck('id');
        $cars = Car::query()->get()->pluck('id');
        $method = $this->method();
        return [
            'driverId' => ['required', 'numeric', Rule::in($drivers)],
            'carId' => ['required', 'numeric', Rule::in($cars)],
            'startDrive' => ['sometimes', 'required', 'datetime'],
            'finishDrive' => ['sometimes', 'nullable', 'datetime'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'driver_id' => $this->driverId,
            'car_id' => $this->carId,
        ]);

        if (key_exists('startDrive', $this->all())) {
            $this->merge([
                'start_drive' => $this->startDrive,
            ]);
        } else {
            $this->merge([
                'start_drive' => now(),
            ]);
        }

        if (key_exists('finishDrive', $this->all())) {
            $this->merge([
                'finish_drive' => $this->finishDrive,
            ]);
        }
    }
}
