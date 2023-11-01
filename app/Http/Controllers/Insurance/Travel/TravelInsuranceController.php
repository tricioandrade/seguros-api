<?php

namespace App\Http\Controllers\Insurance\Travel;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\Travel\TravelInsuranceRequest;
use App\Http\Resources\Insurance\Travel\TravelInsuranceResource;
use App\Services\Insurance\Travel\TravelInsuranceService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TravelInsuranceController extends Controller
{

    public function __construct(
        public TravelInsuranceService $travelInsuranceService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return TravelInsuranceResource::collection($this->travelInsuranceService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TravelInsuranceRequest $travelInsuranceRequest
     * @return TravelInsuranceResource
     * @throws UnauthorizedException
     */
    public function store(TravelInsuranceRequest $travelInsuranceRequest): TravelInsuranceResource
    {
        $travelInsuranceRequest->validated($travelInsuranceRequest->all());
        $travelInsurance = $this->travelInsuranceService->create($travelInsuranceRequest->all());
        return new TravelInsuranceResource($travelInsurance);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TravelInsuranceResource
     * @throws UnauthorizedException
     */
    public function show(int $id): TravelInsuranceResource
    {
        $travelInsurance = $this->travelInsuranceService->getById($id);
        return new TravelInsuranceResource($travelInsurance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TravelInsuranceRequest $travelInsuranceRequest
     * @param int $id
     * @return TravelInsuranceResource
     * @throws UnauthorizedException
     */
    public function update(TravelInsuranceRequest $travelInsuranceRequest, int $id): TravelInsuranceResource
    {
        $travelInsuranceRequest->validated($travelInsuranceRequest->all());
        $travelInsurance = $this->travelInsuranceService->update($travelInsuranceRequest->all(), $id);
        return new TravelInsuranceResource($travelInsurance);
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
        return $this->travelInsuranceService->delete($id);
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
        return $this->travelInsuranceService->forceDelete($id);
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
        return $this->travelInsuranceService->restore($id);
    }
}
