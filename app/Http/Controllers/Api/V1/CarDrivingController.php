<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCarDrivingRequest;
use App\Http\Requests\V1\UpdateCarDrivingRequest;
use App\Models\CarDriving;

class CarDrivingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\V1\StoreCarDrivingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarDrivingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarDriving  $carDriving
     * @return \Illuminate\Http\Response
     */
    public function show(CarDriving $carDriving)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\V1\UpdateCarDrivingRequest  $request
     * @param  \App\Models\CarDriving  $carDriving
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarDrivingRequest $request, CarDriving $carDriving)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarDriving  $carDriving
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarDriving $carDriving)
    {
        //
    }
}
