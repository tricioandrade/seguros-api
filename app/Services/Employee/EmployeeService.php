<?php

namespace App\Services\Employee;

use App\Exceptions\Auth\UnauthorizedException;
use App\Exceptions\DatabaseException;
use App\Models\Employee\EmployeeModel;
use App\Services\Users\UserService;
use App\Traits\Essentials\Database\CrudTrait;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\Common\Auth\VerifyUserTrait;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    use CrudTrait, VerifyUserTrait;

    public function __construct(
        protected UserService $userService
    )
    {
        $this->relations    = ['user'];
        $this->model        = new EmployeeModel();
    }

    public function me()
    {
        return auth()->user()->load($this->userService->relations);
    }

    /**
     * Get all data from the database
     *
     * @return EmployeeModel|Collection
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function getAll(): EmployeeModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->getAllData();
    }

    /**
     * Create a new data in the database
     *
     * @param array $employeeAttributes
     * @param array $userAttributes
     * @return mixed
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function create(
        array $employeeAttributes,
        array $userAttributes
    ): mixed
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        DB::beginTransaction();
        try {
            $user = $this->userService->create($userAttributes);
            $employeeAttributes['user_id'] = $user->id;
            $result = $this->createData($employeeAttributes);

            DB::commit();
            return $result;
        }catch (\Throwable $exception){
            DB::rollBack();
            throw new DatabaseException($exception->getMessage());
        }
    }

    /**
     * Get a data from the database by id
     *
     * @param int $id
     * @return EmployeeModel|Collection
     * @throws UnauthorizedException
     * @throws DatabaseException
     */
    public function getById(int $id): EmployeeModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->getByIdentity($id);
    }

    /**
     * Update a specific data in the database
     *
     * @param array $employeeAttributes
     * @param array $userAttributes
     * @param int $id
     * @return EmployeeModel|Collection
     * @throws UnauthorizedException
     * @throws DatabaseException
     */
    public function update(
        array $employeeAttributes,
        array $userAttributes,
        int $id
    ): EmployeeModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        DB::beginTransaction();
        try {
            $employee = $this->updateData($employeeAttributes, $id);
            $this->userService->update($userAttributes, $employee->user_id);

            DB::commit();
            return $employee;
        }catch (\Throwable $throwable){
            DB::rollBack();
            throw new DatabaseException($throwable->getMessage());
        }
    }

    /**
     * Trash a specified data in the database
     *
     * @param int $id
     * @return mixed
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function delete(int $id): mixed
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        DB::beginTransaction();
        try {
            $employee = $this->getById($id);
            $employee->user()->delete();
            DB::commit();
            return $employee->delete();
        }catch (\Throwable $throwable){
            DB::rollBack();
            throw new DatabaseException($throwable->getMessage());
        }
    }

    /**
     * Permanently delete a specific data in the database
     *
     * @param int $id
     * @return mixed
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function forceDelete(int $id): true
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();

        DB::beginTransaction();
        try {
            $employee = $this->getById($id);
            $employee->user()->delete();
            DB::commit();
            return $employee->forceDelete();
        }catch (\Throwable $throwable){
            DB::rollBack();
            throw new DatabaseException($throwable->getMessage());
        }
    }

    /**
     * Restore a specific data in the database
     *
     * @param int $id
     * @return mixed
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function restore(int $id): mixed
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        DB::beginTransaction();
        try {
            $employee = $this->getById($id);
            $employee->user()->restore();
            DB::commit();
            return $this->restoreData($id);
        }catch (\Throwable $throwable){
            DB::rollBack();
            throw new DatabaseException($throwable->getMessage());
        }
    }
}
