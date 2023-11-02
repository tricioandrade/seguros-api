<?php

namespace App\Http\Controllers\Insurance\Accident;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\Accident\AccidentWorkInsuranceRequest;
use App\Http\Resources\Insurance\Accident\AccidentWorkInsuranceResource;
use App\Services\Insurance\Accident\AccidentWorkInsuranceService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AccidentWorkInsuranceController extends Controller
{

    public function __construct(
        public AccidentWorkInsuranceService $atWorkInsuranceService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return AccidentWorkInsuranceResource::collection($this->atWorkInsuranceService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AccidentWorkInsuranceRequest $atWorkInsuranceRequest
     * @return AccidentWorkInsuranceResource
     * @throws UnauthorizedException
     * @throws DatabaseException
     */
    public function store(AccidentWorkInsuranceRequest $atWorkInsuranceRequest): AccidentWorkInsuranceResource
    {
        $atWorkInsuranceRequest->validated($atWorkInsuranceRequest->all());
        $atWorkInsurance = $this->atWorkInsuranceService->create($atWorkInsuranceRequest->all());
        return new AccidentWorkInsuranceResource($atWorkInsurance);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return AccidentWorkInsuranceResource
     * @throws UnauthorizedException
     */
    public function show(int $id): AccidentWorkInsuranceResource
    {
        $atWorkInsurance = $this->atWorkInsuranceService->getById($id);
        return new AccidentWorkInsuranceResource($atWorkInsurance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AccidentWorkInsuranceRequest $atWorkInsuranceRequest
     * @param int $id
     * @return AccidentWorkInsuranceResource
     * @throws UnauthorizedException
     */
    public function update(AccidentWorkInsuranceRequest $atWorkInsuranceRequest, int $id): AccidentWorkInsuranceResource
    {
        $atWorkInsuranceRequest->validated($atWorkInsuranceRequest->all());
        $atWorkInsurance = $this->atWorkInsuranceService->update($atWorkInsuranceRequest->all(), $id);
        return new AccidentWorkInsuranceResource($atWorkInsurance);
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
