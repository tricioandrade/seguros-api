<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\PolicieStatusEnumRequest;
use App\Http\Resources\Insurance\PolicieStatusEnumResource;
use App\Services\Insurance\PolicieStatusEnumService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PolicieStatusEnumController extends Controller
{

    public function __construct(
        public PolicieStatusEnumService $policieStatusEnumService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return PolicieStatusEnumResource::collection($this->policieStatusEnumService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PolicieStatusEnumRequest $policieStatusEnumRequest
     * @return PolicieStatusEnumResource
     * @throws UnauthorizedException
     */
    public function store(PolicieStatusEnumRequest $policieStatusEnumRequest): PolicieStatusEnumResource
    {
        $policieStatusEnumRequest->validated($policieStatusEnumRequest->all());
        $policieStatusEnum = $this->policieStatusEnumService->create($policieStatusEnumRequest->all());
        return new PolicieStatusEnumResource($policieStatusEnum);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PolicieStatusEnumResource
     * @throws UnauthorizedException
     */
    public function show(int $id): PolicieStatusEnumResource
    {
        $policieStatusEnum = $this->policieStatusEnumService->getById($id);
        return new PolicieStatusEnumResource($policieStatusEnum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PolicieStatusEnumRequest $policieStatusEnumRequest
     * @param int $id
     * @return PolicieStatusEnumResource
     * @throws UnauthorizedException
     */
    public function update(PolicieStatusEnumRequest $policieStatusEnumRequest, int $id): PolicieStatusEnumResource
    {
        $policieStatusEnumRequest->validated($policieStatusEnumRequest->all());
        $policieStatusEnum = $this->policieStatusEnumService->update($policieStatusEnumRequest->all(), $id);
        return new PolicieStatusEnumResource($policieStatusEnum);
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
        return $this->policieStatusEnumService->delete($id);
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
        return $this->policieStatusEnumService->forceDelete($id);
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
        return $this->policieStatusEnumService->restore($id);
    }
}
