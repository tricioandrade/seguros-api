<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Company\CompanyRequest;
use App\Http\Resources\Company\CompanyResource;
use App\Services\Company\CompanyService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{

    public function __construct(
        public CompanyService $companyService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return CompanyResource::collection($this->companyService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyRequest $companyRequest
     * @return CompanyResource
     * @throws UnauthorizedException
     */
    public function store(CompanyRequest $companyRequest): CompanyResource
    {
        $companyRequest->validated($companyRequest->all());
        $company = $this->companyService->create($companyRequest->all());
        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CompanyResource
     * @throws UnauthorizedException
     */
    public function show(int $id): CompanyResource
    {
        $company = $this->companyService->getById($id);
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyRequest $companyRequest
     * @param int $id
     * @return CompanyResource
     * @throws UnauthorizedException
     */
    public function update(CompanyRequest $companyRequest, int $id): CompanyResource
    {
        $companyRequest->validated($companyRequest->all());
        $company = $this->companyService->update($companyRequest->all(), $id);
        return new CompanyResource($company);
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
        return $this->companyService->delete($id);
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
        return $this->companyService->forceDelete($id);
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
        return $this->companyService->restore($id);
    }
}
