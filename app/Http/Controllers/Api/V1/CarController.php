<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCarRequest;
use App\Http\Requests\V1\UpdateCarRequest;
use App\Http\Resources\V1\CarResource;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::query()
            ->get()
            ->sortDesc();

        return response([
            'cars' => CarResource::collection($cars),
            'message' => 'Retrieved successfully',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\V1\StoreCarRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->input());
        return response([
            'car' => new CarResource($car),
            'message' => 'New Car created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return response([
            'driver' => new CarResource($car),
            'message' => 'Retrieved successfully',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\V1\UpdateCarRequest $request
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->input());

        return response([
            'car' => new CarResource($car),
            'message' => 'Car successfully updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return response([
            'message' => 'Car successfully deleted',
        ]);
    }
}
