<?php

namespace App\Http\Controllers\Client\Vehicle;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Client\Vehicle\VehicleRequest;
use App\Http\Resources\Client\Vehicle\VehicleResource;
use App\Services\Client\Vehicle\VehicleService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleController extends Controller
{

    public function __construct(
        public VehicleService $vehicleService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return VehicleResource::collection($this->vehicleService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleRequest $vehicleRequest
     * @return VehicleResource
     * @throws UnauthorizedException
     */
    public function store(VehicleRequest $vehicleRequest): VehicleResource
    {
        $vehicleRequest->validated($vehicleRequest->all());
        $vehicle = $this->vehicleService->create($vehicleRequest->all());
        return new VehicleResource($vehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return VehicleResource
     * @throws UnauthorizedException
     */
    public function show(int $id): VehicleResource
    {
        $vehicle = $this->vehicleService->getById($id);
        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleRequest $vehicleRequest
     * @param int $id
     * @return VehicleResource
     * @throws UnauthorizedException
     */
    public function update(VehicleRequest $vehicleRequest, int $id): VehicleResource
    {
        $vehicleRequest->validated($vehicleRequest->all());
        $vehicle = $this->vehicleService->update($vehicleRequest->all(), $id);
        return new VehicleResource($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @throws UnauthorizedException
     */
    public function destroy(int $id): mixed
    {
        return $this->vehicleService->delete($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @throws UnauthorizedException
     */
    public function forceDelete(int $id): mixed
    {
        return $this->vehicleService->forceDelete($id);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @throws UnauthorizedException
     */
    public function restore(int $id): mixed
    {
        return $this->vehicleService->restore($id);
    }
}
