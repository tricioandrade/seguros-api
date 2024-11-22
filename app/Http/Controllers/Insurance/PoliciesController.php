<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\PoliciesRequest;
use App\Http\Resources\Insurance\PoliciesResource;
use App\Services\Insurance\PoliciesService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PoliciesController extends Controller
{

    public function __construct(
        public PoliciesService $policiesService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return PoliciesResource::collection($this->policiesService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PoliciesRequest $policiesRequest
     * @return PoliciesResource
     * @throws UnauthorizedException
     */
    public function store(PoliciesRequest $policiesRequest): PoliciesResource
    {
        $policiesRequest->validated($policiesRequest->all());
        $policies = $this->policiesService->create($policiesRequest->all());
        return new PoliciesResource($policies);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PoliciesResource
     * @throws UnauthorizedException
     */
    public function show(int $id): PoliciesResource
    {
        $policies = $this->policiesService->getById($id);
        return new PoliciesResource($policies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PoliciesRequest $policiesRequest
     * @param int $id
     * @return PoliciesResource
     * @throws UnauthorizedException
     */
    public function update(PoliciesRequest $policiesRequest, int $id): PoliciesResource
    {
        $policiesRequest->validated($policiesRequest->all());
        $policies = $this->policiesService->update($policiesRequest->all(), $id);
        return new PoliciesResource($policies);
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
        return $this->policiesService->delete($id);
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
        return $this->policiesService->forceDelete($id);
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
        return $this->policiesService->restore($id);
    }
}
