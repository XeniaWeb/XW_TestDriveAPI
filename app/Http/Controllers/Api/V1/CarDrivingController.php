<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCarDrivingRequest;
use App\Http\Resources\v1\CarDrivingResource;
use App\Models\Car;
use App\Models\CarDriving;
use App\Models\Driver;

class CarDrivingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carDrivings = CarDriving::query()
            ->get()
            ->sortDesc();

        return response([
            'carDrivings' => CarDrivingResource::collection($carDrivings),
            'message' => 'That is all'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\V1\StoreCarDrivingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarDrivingRequest $request)
    {
        $driverId = $request->input('driver_id');
        $carId = $request->input('car_id');

        $activeCarDrivings = CarDriving::query()
            ->where('finish_drive', '=', null)
            ->get();

        if (count($activeCarDrivings->where('driver_id', '=', $driverId)) !== 0) {
            return response([
                'message' => 'Driver is busy or did not return the previous car. New Car-Driving impossible',
            ]);
        } elseif (count($activeCarDrivings->where('car_id', '=', $carId)) !== 0) {
            return response([
                'message' => 'This Car is busy now. New Car-Driving impossible',
            ]);
        }

        $carDriving = CarDriving::create($request->input());

        if ($carDriving) {
            Driver::where('id', '=', $carDriving->driver_id)->update([
                'is_free' => false
            ]);
            Car::where('id', '=', $carDriving->car_id)->update([
                'is_free' => false
            ]);
        }

        return response([
            'carDriving' => new CarDrivingResource($carDriving),
            'message' => 'New Car-Driving created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarDriving  $carDriving
     * @return \Illuminate\Http\Response
     */
    public function show(CarDriving $carDriving)
    {
        return response([
            'carDriving' => new CarDrivingResource($carDriving),
            'message' => 'Retrieved successfully',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\CarDriving  $carDriving
     * @return \Illuminate\Http\Response
     */
    public function finishDrive(CarDriving $carDriving)
    {
        if ($carDriving->finish_drive !== null) {
            return response([
                'message' => 'This Car-Driving is already finished.',
            ]);
        }
        $driver = Driver::query()
            ->where('id', '=', $carDriving->driver_id)
            ->first();
        $car = Car::query()
            ->where('id', '=', $carDriving->car_id)
            ->first();
        if (!$driver || !$car) {
            return response([
                'message' => 'Driver or Car not found, ask for Admin',
            ]);
        } else {
            $driver->update([
                'is_free' => true
            ]);
            $car->update([
                'is_free' => true
            ]);
            $carDriving->update([
                'finish_drive' => now(),
            ]);
        }

        return response([
            'carDriving' => new CarDrivingResource($carDriving),
            'message' => 'Car-Driving finished successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarDriving  $carDriving
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarDriving $carDriving)
    {
        $carDriving->delete();
        return response([
            'message' => 'Car-Driving successfully deleted',
        ]);
    }
}
