<?php

namespace App\Http\Controllers\Insurance;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\InsuranceRequest;
use App\Http\Resources\Insurance\InsuranceResource;
use App\Services\Insurance\InsuranceService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InsuranceController extends Controller
{

    public function __construct(
        public InsuranceService $insuranceService
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
        return InsuranceResource::collection($this->insuranceService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InsuranceRequest $insuranceRequest
     * @return InsuranceResource
     * @throws UnauthorizedException
     * @throws DatabaseException
     */
    public function store(InsuranceRequest $insuranceRequest): InsuranceResource
    {
        $insuranceRequest->validated($insuranceRequest->all());
        $insurance = $this->insuranceService->create($insuranceRequest->all());
        return new InsuranceResource($insurance);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return InsuranceResource
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function show(int $id): InsuranceResource
    {
        $insurance = $this->insuranceService->getById($id);
        return new InsuranceResource($insurance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param InsuranceRequest $insuranceRequest
     * @param int $id
     * @return InsuranceResource
     * @throws UnauthorizedException
     */
    public function update(InsuranceRequest $insuranceRequest, int $id): InsuranceResource
    {
        $insuranceRequest->validated($insuranceRequest->all());
        $insurance = $this->insuranceService->update($insuranceRequest->all(), $id);
        return new InsuranceResource($insurance);
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
        return $this->insuranceService->delete($id);
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
        return $this->insuranceService->forceDelete($id);
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
        return $this->insuranceService->restore($id);
    }
}
