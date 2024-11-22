<?php

namespace App\Services\Users;

use App\Exceptions\Auth\UnauthorizedException;
use App\Exceptions\DatabaseException;
use App\Models\User\UserModel;
use App\Traits\Essentials\Database\CrudTrait;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\Common\Auth\VerifyUserTrait;

class UserService
{
    use CrudTrait, VerifyUserTrait;

    public function __construct()
    {
        $this->relations    = [
            'employee',
            'insurance',
            'policy',
        ];

        $this->model        = new UserModel();
    }

    /**
     * Get all data from the database
     *
     * @return UserModel|Collection
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function getAll(): UserModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->getAllData();
    }

    /**
     * Create a new data in the database
     *
     * @throws UnauthorizedException
     * @throws DatabaseException
     */
    public function create(array $attributes) {
        $user = $this->getByAnonymousInfo('email', $attributes['email'])->first();
        if ($user) {
            if (!$this->isAdmin()) throw new UnauthorizedException();
            if ($user->deleted_at) {
                $user->is_blocked   = $attributes['is_blocked'];
                $user->is_admin     = $attributes['is_admin'];
                $user->password     = $attributes['password'];

                $user->save();
                $user->restore();
            }
            return $user->load($this->relations);
        }
        return $this->createData($attributes);
    }

    /**
     * Get a data from the database by id
     *
     * @param int $id
     * @return UserModel|Collection
     * @throws UnauthorizedException
     * @throws DatabaseException
     */
    public function getById(int $id): UserModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->getByIdentity($id);
    }

    /**
     * Update a specific data in the database
     *
     * @param array $attributes
     * @param int $id
     * @return UserModel|Collection
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function update(array $attributes, int $id): UserModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return  $this->updateData($attributes, $id);
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
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function restore(int $id): mixed
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->restoreData($id);
    }
}
