<?php

namespace App\Http\Controllers\Insurance\Policie;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\Policie\PoliceStatusEnumRequest;
use App\Http\Resources\Insurance\Policie\PoliceStatusEnumResource;
use App\Services\Insurance\Policie\PoliceStatusEnumService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PoliceStatusEnumController extends Controller
{

    public function __construct(
        public PoliceStatusEnumService $policeStatusEnumService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return PoliceStatusEnumResource::collection($this->policeStatusEnumService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PoliceStatusEnumRequest $policeStatusEnumRequest
     * @return PoliceStatusEnumResource
     * @throws UnauthorizedException
     */
    public function store(PoliceStatusEnumRequest $policeStatusEnumRequest): PoliceStatusEnumResource
    {
        $policeStatusEnumRequest->validated($policeStatusEnumRequest->all());
        $policeStatusEnum = $this->policeStatusEnumService->create($policeStatusEnumRequest->all());
        return new PoliceStatusEnumResource($policeStatusEnum);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PoliceStatusEnumResource
     * @throws UnauthorizedException
     */
    public function show(int $id): PoliceStatusEnumResource
    {
        $policeStatusEnum = $this->policeStatusEnumService->getById($id);
        return new PoliceStatusEnumResource($policeStatusEnum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PoliceStatusEnumRequest $policeStatusEnumRequest
     * @param int $id
     * @return PoliceStatusEnumResource
     * @throws UnauthorizedException
     */
    public function update(PoliceStatusEnumRequest $policeStatusEnumRequest, int $id): PoliceStatusEnumResource
    {
        $policeStatusEnumRequest->validated($policeStatusEnumRequest->all());
        $policeStatusEnum = $this->policeStatusEnumService->update($policeStatusEnumRequest->all(), $id);
        return new PoliceStatusEnumResource($policeStatusEnum);
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
        return $this->policeStatusEnumService->delete($id);
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
        return $this->policeStatusEnumService->forceDelete($id);
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
        return $this->policeStatusEnumService->restore($id);
    }
}
