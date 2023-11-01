<?php

namespace App\Http\Controllers\Insurance\Car;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Insurance\Car\CarInsuranceRequest;
use App\Http\Resources\Insurance\Car\CarInsuranceResource;
use App\Services\Insurance\Car\CarInsuranceService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarInsuranceController extends Controller
{

    public function __construct(
        public CarInsuranceService $carInsuranceService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return CarInsuranceResource::collection($this->carInsuranceService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarInsuranceRequest $carInsuranceRequest
     * @return CarInsuranceResource
     * @throws UnauthorizedException
     */
    public function store(CarInsuranceRequest $carInsuranceRequest): CarInsuranceResource
    {
        $carInsuranceRequest->validated($carInsuranceRequest->all());
        $carInsurance = $this->carInsuranceService->create($carInsuranceRequest->all());
        return new CarInsuranceResource($carInsurance);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CarInsuranceResource
     * @throws UnauthorizedException
     */
    public function show(int $id): CarInsuranceResource
    {
        $carInsurance = $this->carInsuranceService->getById($id);
        return new CarInsuranceResource($carInsurance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CarInsuranceRequest $carInsuranceRequest
     * @param int $id
     * @return CarInsuranceResource
     * @throws UnauthorizedException
     */
    public function update(CarInsuranceRequest $carInsuranceRequest, int $id): CarInsuranceResource
    {
        $carInsuranceRequest->validated($carInsuranceRequest->all());
        $carInsurance = $this->carInsuranceService->update($carInsuranceRequest->all(), $id);
        return new CarInsuranceResource($carInsurance);
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
        return $this->carInsuranceService->delete($id);
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
        return $this->carInsuranceService->forceDelete($id);
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
        return $this->carInsuranceService->restore($id);
    }
}
