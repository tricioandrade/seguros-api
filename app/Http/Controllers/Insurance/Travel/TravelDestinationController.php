<?php

namespace App\Http\Controllers\Insurance\Travel;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\Travel\TravelDestinationRequest;
use App\Http\Resources\Insurance\Travel\TravelDestinationResource;
use App\Services\Insurance\Travel\TravelDestinationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TravelDestinationController extends Controller
{

    public function __construct(
        public TravelDestinationService $travelDestinationService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return TravelDestinationResource::collection($this->travelDestinationService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TravelDestinationRequest $travelDestinationRequest
     * @return TravelDestinationResource
     * @throws UnauthorizedException
     */
    public function store(TravelDestinationRequest $travelDestinationRequest): TravelDestinationResource
    {
        $travelDestinationRequest->validated($travelDestinationRequest->all());
        $travelDestination = $this->travelDestinationService->create($travelDestinationRequest->all());
        return new TravelDestinationResource($travelDestination);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TravelDestinationResource
     * @throws UnauthorizedException
     */
    public function show(int $id): TravelDestinationResource
    {
        $travelDestination = $this->travelDestinationService->getById($id);
        return new TravelDestinationResource($travelDestination);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TravelDestinationRequest $travelDestinationRequest
     * @param int $id
     * @return TravelDestinationResource
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function update(TravelDestinationRequest $travelDestinationRequest, int $id): TravelDestinationResource
    {
        $travelDestinationRequest->validated($travelDestinationRequest->all());
        $travelDestination = $this->travelDestinationService->update($travelDestinationRequest->all(), $id);
        return new TravelDestinationResource($travelDestination);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @throws UnauthorizedException
     * @throws DatabaseException
     */
    public function destroy(int $id): mixed
    {
        return $this->travelDestinationService->delete($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function forceDelete(int $id): mixed
    {
        return $this->travelDestinationService->forceDelete($id);
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
        return $this->travelDestinationService->restore($id);
    }
}
