<?php

namespace App\Http\Controllers\Insurance\Vehicle;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\Vehicle\VehicleInsuranceRequest;
use App\Http\Resources\Insurance\Vehicle\VehicleInsuranceResource;
use App\Services\Insurance\Vehicle\VehicleInsuranceService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleInsuranceController extends Controller
{

    public function __construct(
        public VehicleInsuranceService $vehicleInsuranceService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return VehicleInsuranceResource::collection($this->vehicleInsuranceService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleInsuranceRequest $vehicleInsuranceRequest
     * @return VehicleInsuranceResource
     * @throws UnauthorizedException
     * @throws DatabaseException
     */
    public function store(VehicleInsuranceRequest $vehicleInsuranceRequest): VehicleInsuranceResource
    {
        $vehicleInsuranceRequest->validated($vehicleInsuranceRequest->all());
        $vehicleInsurance = $this->vehicleInsuranceService->create($vehicleInsuranceRequest->all());
        return new VehicleInsuranceResource($vehicleInsurance);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return VehicleInsuranceResource
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function show(int $id): VehicleInsuranceResource
    {
        $vehicleInsurance = $this->vehicleInsuranceService->getById($id);
        return new VehicleInsuranceResource($vehicleInsurance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleInsuranceRequest $vehicleInsuranceRequest
     * @param int $id
     * @return VehicleInsuranceResource
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function update(VehicleInsuranceRequest $vehicleInsuranceRequest, int $id): VehicleInsuranceResource
    {
        $vehicleInsuranceRequest->validated($vehicleInsuranceRequest->all());
        $vehicleInsurance = $this->vehicleInsuranceService->update($vehicleInsuranceRequest->all(), $id);
        return new VehicleInsuranceResource($vehicleInsurance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function destroy(int $id): mixed
    {
        return $this->vehicleInsuranceService->delete($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function forceDelete(int $id): mixed
    {
        return $this->vehicleInsuranceService->forceDelete($id);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function restore(int $id): mixed
    {
        return $this->vehicleInsuranceService->restore($id);
    }
}
