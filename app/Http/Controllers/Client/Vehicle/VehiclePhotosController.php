<?php

namespace App\Http\Controllers\Client\Vehicle;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Client\Vehicle\VehiclePhotosRequest;
use App\Http\Resources\Client\Vehicle\VehiclePhotosResource;
use App\Services\Client\Vehicle\VehiclePhotosService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehiclePhotosController extends Controller
{

    public function __construct(
        public VehiclePhotosService $vehiclePhotosService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return VehiclePhotosResource::collection($this->vehiclePhotosService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehiclePhotosRequest $vehiclePhotosRequest
     * @return VehiclePhotosResource
     * @throws UnauthorizedException
     */
    public function store(VehiclePhotosRequest $vehiclePhotosRequest): VehiclePhotosResource
    {
        $vehiclePhotosRequest->validated($vehiclePhotosRequest->all());
        $vehiclePhotos = $this->vehiclePhotosService->create($vehiclePhotosRequest->all());
        return new VehiclePhotosResource($vehiclePhotos);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return VehiclePhotosResource
     * @throws UnauthorizedException
     */
    public function show(int $id): VehiclePhotosResource
    {
        $vehiclePhotos = $this->vehiclePhotosService->getById($id);
        return new VehiclePhotosResource($vehiclePhotos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehiclePhotosRequest $vehiclePhotosRequest
     * @param int $id
     * @return VehiclePhotosResource
     * @throws UnauthorizedException
     */
    public function update(VehiclePhotosRequest $vehiclePhotosRequest, int $id): VehiclePhotosResource
    {
        $vehiclePhotosRequest->validated($vehiclePhotosRequest->all());
        $vehiclePhotos = $this->vehiclePhotosService->update($vehiclePhotosRequest->all(), $id);
        return new VehiclePhotosResource($vehiclePhotos);
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
        return $this->vehiclePhotosService->delete($id);
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
        return $this->vehiclePhotosService->forceDelete($id);
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
        return $this->vehiclePhotosService->restore($id);
    }
}
