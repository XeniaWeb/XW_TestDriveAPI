<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CarDrivingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $driver = [
            'id' => $this->driver->id,
            'name' => $this->driver->name,
            'nickname' => $this->driver->nickname,
            'email' => $this->driver->email,
            'phone' => $this->driver->phone,
            'age' => $this->driver->age,
            'isFree' => $this->driver->is_free,
        ];
        $car = [
            'id' => $this->car->id,
            'brand' => $this->car->brand,
            'model' => $this->car->model,
            'ageYear' => $this->car->age_year,
            'isFree' => $this->car->is_free,
        ];

        return [
            'driverId' => $this->driver_id,
            'carId' => $this->car_id,
            'startDrive' => $this->start_drive,
            'finishDrive' => $this->finish_drive,
            'car' => $car,
            'driver' => $driver,
        ];
    }
}
