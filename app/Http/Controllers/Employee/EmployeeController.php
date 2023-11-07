<?php

namespace App\Http\Controllers\Employee;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Http\Requests\Users\UserRequest;
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
     * @throws DatabaseException
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
     * @throws DatabaseException
     */
    public function store(EmployeeRequest $employeeRequest, UserRequest $userRequest): EmployeeResource
    {
        $employeeRequest->validated($employeeRequest->all());
        $userRequest->validated($userRequest->all());

        $employee = $this->employeeService->create($employeeRequest->all(), $userRequest->all());
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
     * @param UserRequest $userRequest
     * @param int $employeeId
     * @return EmployeeResource
     * @throws UnauthorizedException
     */
    public function update(
        EmployeeRequest $employeeRequest,
        UserRequest $userRequest,
        int $employeeId
    ): EmployeeResource
    {
        $employeeRequest->validated($employeeRequest->all());
        $userRequest->validated($userRequest->all());

        $employee = $this->employeeService->update(
            $employeeRequest->all(),
            $userRequest->all(),
            $employeeId
        );

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
