<?php

namespace App\Services\Insurance\Accident;

use App\Exceptions\Auth\UnauthorizedException;
use App\Exceptions\DatabaseException;
use App\Models\Insurance\Accident\AccidentWorkInsuranceModel;
use App\Traits\Essentials\Database\CrudTrait;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\Common\Auth\VerifyUserTrait;

class AccidentWorkInsuranceService
{
    use CrudTrait, VerifyUserTrait;

    public function __construct()
    {
        $this->relations    = [];
        $this->model        = new AccidentWorkInsuranceModel();
    }

    /**
     * Get all data from the database
     *
     * @return AccidentWorkInsuranceModel|Collection
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function getAll(): AccidentWorkInsuranceModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->getAllData();
    }

    /**
     * Create a new data in the database
     *
     * @param array $attributes
     * @return mixed
     * @throws UnauthorizedException
     * @throws DatabaseException
     */
    public function create(array $attributes): mixed
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        $attributes->user_id = auth()->id();
        return $this->createData($attributes);
    }

    /**
     * Get a data from the database by id
     *
     * @param int $id
     * @return AccidentWorkInsuranceModel|Collection
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function getById(int $id): AccidentWorkInsuranceModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->getByIdentity($id);
    }

    /**
     * Update a specific data in the database
     *
     * @param array $attributes
     * @param int $id
     * @return AccidentWorkInsuranceModel|Collection
     * @throws UnauthorizedException
     */
    public function update(array $attributes, int $id): AccidentWorkInsuranceModel|Collection
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
