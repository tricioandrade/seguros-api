<?php

namespace App\Http\Controllers\Insurance\Travel;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\Travel\TravelDestinyRequest;
use App\Http\Resources\Insurance\Travel\TravelDestinyResource;
use App\Services\Insurance\Travel\TravelDestinyService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TravelDestinyController extends Controller
{

    public function __construct(
        public TravelDestinyService $travelDestinyService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return TravelDestinyResource::collection($this->travelDestinyService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TravelDestinyRequest $travelDestinyRequest
     * @return TravelDestinyResource
     * @throws UnauthorizedException
     */
    public function store(TravelDestinyRequest $travelDestinyRequest): TravelDestinyResource
    {
        $travelDestinyRequest->validated($travelDestinyRequest->all());
        $travelDestiny = $this->travelDestinyService->create($travelDestinyRequest->all());
        return new TravelDestinyResource($travelDestiny);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TravelDestinyResource
     * @throws UnauthorizedException
     */
    public function show(int $id): TravelDestinyResource
    {
        $travelDestiny = $this->travelDestinyService->getById($id);
        return new TravelDestinyResource($travelDestiny);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TravelDestinyRequest $travelDestinyRequest
     * @param int $id
     * @return TravelDestinyResource
     * @throws UnauthorizedException
     */
    public function update(TravelDestinyRequest $travelDestinyRequest, int $id): TravelDestinyResource
    {
        $travelDestinyRequest->validated($travelDestinyRequest->all());
        $travelDestiny = $this->travelDestinyService->update($travelDestinyRequest->all(), $id);
        return new TravelDestinyResource($travelDestiny);
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
        return $this->travelDestinyService->delete($id);
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
        return $this->travelDestinyService->forceDelete($id);
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
        return $this->travelDestinyService->restore($id);
    }
}
