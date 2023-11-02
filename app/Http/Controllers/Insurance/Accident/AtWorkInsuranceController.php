<?php

namespace App\Http\Controllers\Insurance\Accident;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\Accident\AtWorkInsuranceRequest;
use App\Http\Resources\Insurance\Accident\AtWorkInsuranceResource;
use App\Services\Insurance\Accident\AtWorkInsuranceService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AtWorkInsuranceController extends Controller
{

    public function __construct(
        public AtWorkInsuranceService $atWorkInsuranceService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return AtWorkInsuranceResource::collection($this->atWorkInsuranceService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AtWorkInsuranceRequest $atWorkInsuranceRequest
     * @return AtWorkInsuranceResource
     * @throws UnauthorizedException
     * @throws DatabaseException
     */
    public function store(AtWorkInsuranceRequest $atWorkInsuranceRequest): AtWorkInsuranceResource
    {
        $atWorkInsuranceRequest->validated($atWorkInsuranceRequest->all());
        $atWorkInsurance = $this->atWorkInsuranceService->create($atWorkInsuranceRequest->all());
        return new AtWorkInsuranceResource($atWorkInsurance);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return AtWorkInsuranceResource
     * @throws UnauthorizedException
     */
    public function show(int $id): AtWorkInsuranceResource
    {
        $atWorkInsurance = $this->atWorkInsuranceService->getById($id);
        return new AtWorkInsuranceResource($atWorkInsurance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AtWorkInsuranceRequest $atWorkInsuranceRequest
     * @param int $id
     * @return AtWorkInsuranceResource
     * @throws UnauthorizedException
     */
    public function update(AtWorkInsuranceRequest $atWorkInsuranceRequest, int $id): AtWorkInsuranceResource
    {
        $atWorkInsuranceRequest->validated($atWorkInsuranceRequest->all());
        $atWorkInsurance = $this->atWorkInsuranceService->update($atWorkInsuranceRequest->all(), $id);
        return new AtWorkInsuranceResource($atWorkInsurance);
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
        return $this->atWorkInsuranceService->delete($id);
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
        return $this->atWorkInsuranceService->forceDelete($id);
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
        return $this->atWorkInsuranceService->restore($id);
    }
}
