<?php

namespace App\Http\Controllers\Insurance\Claim;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\Claim\ClaimPhotosRequest;
use App\Http\Resources\Insurance\Claim\ClaimPhotosResource;
use App\Services\Insurance\Claim\ClaimPhotosService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClaimPhotosController extends Controller
{

    public function __construct(
        public ClaimPhotosService $claimPhotosService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return ClaimPhotosResource::collection($this->claimPhotosService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClaimPhotosRequest $claimPhotosRequest
     * @return ClaimPhotosResource
     * @throws UnauthorizedException
     */
    public function store(ClaimPhotosRequest $claimPhotosRequest): ClaimPhotosResource
    {
        $claimPhotosRequest->validated($claimPhotosRequest->all());
        $claimPhotos = $this->claimPhotosService->create($claimPhotosRequest->all());
        return new ClaimPhotosResource($claimPhotos);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ClaimPhotosResource
     * @throws UnauthorizedException
     */
    public function show(int $id): ClaimPhotosResource
    {
        $claimPhotos = $this->claimPhotosService->getById($id);
        return new ClaimPhotosResource($claimPhotos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClaimPhotosRequest $claimPhotosRequest
     * @param int $id
     * @return ClaimPhotosResource
     * @throws UnauthorizedException
     */
    public function update(ClaimPhotosRequest $claimPhotosRequest, int $id): ClaimPhotosResource
    {
        $claimPhotosRequest->validated($claimPhotosRequest->all());
        $claimPhotos = $this->claimPhotosService->update($claimPhotosRequest->all(), $id);
        return new ClaimPhotosResource($claimPhotos);
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
        return $this->claimPhotosService->delete($id);
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
        return $this->claimPhotosService->forceDelete($id);
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
        return $this->claimPhotosService->restore($id);
    }
}
