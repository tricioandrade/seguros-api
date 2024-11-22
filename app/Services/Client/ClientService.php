<?php

namespace App\Services\Client;

use App\Exceptions\Auth\UnauthorizedException;
use App\Exceptions\DatabaseException;
use App\Models\Client\ClientModel;
use App\Services\Users\UserService;
use App\Traits\Essentials\Database\CrudTrait;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\Common\Auth\VerifyUserTrait;
use Illuminate\Support\Facades\DB;

class ClientService
{
    use CrudTrait, VerifyUserTrait;

    public function __construct(
        protected UserService $userService
    )
    {
        $this->relations    = ['user'];
        $this->model        = new ClientModel();
    }

    /**
     * Get all data from the database
     *
     * @return ClientModel|Collection
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function getAll(): ClientModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->getAllData();
    }

    /**
     * Create a new data in the database
     *
     * @param array $clientAttributes
     * @param array $userAttributes
     * @return mixed
     * @throws DatabaseException
     */
    public function create(
        array $clientAttributes,
        array $userAttributes
    ): mixed
    {
        DB::beginTransaction();
        try {
            $user = $this->userService->create($userAttributes);
            $clientAttributes['user_id'] = $user->id;
            $result = $this->createData($clientAttributes);

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
     * @return ClientModel|Collection
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function getById(int $id): ClientModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->getByIdentity($id);
    }

    /**
     * Update a specific data in the database
     *
     * @param array $clientAttributes
     * @param array $userAttributes
     * @param int $id
     * @return ClientModel|Collection
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function update(
        array $clientAttributes,
        array $userAttributes,
        int $id
    ): ClientModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        DB::beginTransaction();
        try {
            $client = $this->updateData($clientAttributes, $id);
            $this->userService->update($userAttributes, $client->user_id);

            DB::commit();
            return $client;
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
        return $this->deleteData($id);
    }

    /**
     * Permanently delete a specific data in the database
     *
     * @param int $id
     * @return mixed
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function forceDelete(int $id): mixed
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->forceDeleteData($id);
    }

    /**
     * Restore a specific data in the database
     *
     * @param int $id
     * @return mixed
     * @throws UnauthorizedException
     */
    public function restore(int $id): mixed
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->restoreData($id);
    }
}
