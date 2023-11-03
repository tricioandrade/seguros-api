<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Http\Resources\Employee\EmployeeResource;
use App\Services\Employee\EmployeeService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EmployeeController extends Controller
{

    public function __construct(
        public EmployeeService $employeeService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return EmployeeResource::collection($this->employeeService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $employeeRequest
     * @return EmployeeResource
     * @throws UnauthorizedException
     */
    public function store(EmployeeRequest $employeeRequest): EmployeeResource
    {
        $employeeRequest->validated($employeeRequest->all());
        $employee = $this->employeeService->create($employeeRequest->all());
        return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return EmployeeResource
     * @throws UnauthorizedException
     */
    public function show(int $id): EmployeeResource
    {
        $employee = $this->employeeService->getById($id);
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $employeeRequest
     * @param int $id
     * @return EmployeeResource
     * @throws UnauthorizedException
     */
    public function update(EmployeeRequest $employeeRequest, int $id): EmployeeResource
    {
        $employeeRequest->validated($employeeRequest->all());
        $employee = $this->employeeService->update($employeeRequest->all(), $id);
        return new EmployeeResource($employee);
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
        return $this->employeeService->delete($id);
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
        return $this->employeeService->forceDelete($id);
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
        return $this->employeeService->restore($id);
    }
}
