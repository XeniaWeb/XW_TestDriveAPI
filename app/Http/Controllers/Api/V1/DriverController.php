<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreDriverRequest;
use App\Http\Requests\V1\UpdateDriverRequest;
use App\Http\Resources\V1\DriverResource;
use App\Models\Driver;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::query()
            ->get()
            ->sortDesc();

        return response([
            'drivers' => DriverResource::collection($drivers),
            'message' => 'Retrieved successfully',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\V1\StoreDriverRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create($request->input());
        return response([
            'driver' => new DriverResource($driver),
            'message' => 'New Driver created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Driver $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        return response([
            'driver' => new DriverResource($driver),
            'message' => 'Retrieved successfully',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\V1\UpdateDriverRequest $request
     * @param \App\Models\Driver $driver
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update($request->input());

        return response([
            'driver' => new DriverResource($driver),
            'message' => 'Driver successfully updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Driver $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return response([
            'message' => 'Driver successfully deleted',
        ]);
    }
}
