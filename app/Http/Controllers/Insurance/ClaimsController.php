<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\ClaimsRequest;
use App\Http\Resources\Insurance\ClaimsResource;
use App\Services\Insurance\ClaimsService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClaimsController extends Controller
{

    public function __construct(
        public ClaimsService $claimsService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return ClaimsResource::collection($this->claimsService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClaimsRequest $claimsRequest
     * @return ClaimsResource
     * @throws UnauthorizedException
     */
    public function store(ClaimsRequest $claimsRequest): ClaimsResource
    {
        $claimsRequest->validated($claimsRequest->all());
        $claims = $this->claimsService->create($claimsRequest->all());
        return new ClaimsResource($claims);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ClaimsResource
     * @throws UnauthorizedException
     */
    public function show(int $id): ClaimsResource
    {
        $claims = $this->claimsService->getById($id);
        return new ClaimsResource($claims);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClaimsRequest $claimsRequest
     * @param int $id
     * @return ClaimsResource
     * @throws UnauthorizedException
     */
    public function update(ClaimsRequest $claimsRequest, int $id): ClaimsResource
    {
        $claimsRequest->validated($claimsRequest->all());
        $claims = $this->claimsService->update($claimsRequest->all(), $id);
        return new ClaimsResource($claims);
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
        return $this->claimsService->delete($id);
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
        return $this->claimsService->forceDelete($id);
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
        return $this->claimsService->restore($id);
    }
}
