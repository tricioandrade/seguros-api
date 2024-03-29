<?php

namespace App\Services\Insurance\Travel;

use App\Exceptions\Auth\UnauthorizedException;
use App\Models\Insurance\Travel\TravelInsuranceModel;
use App\Traits\Essentials\Database\CrudTrait;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\Common\Auth\VerifyUserTrait;

class TravelInsuranceService
{
    use CrudTrait, VerifyUserTrait;

    public function __construct()
    {
        $this->relations    = [];
        $this->model        = new TravelInsuranceModel();
    }

    /**
     * Get all data from the database
     *
     * @throws UnauthorizedException
     */
    public function getAll(): TravelInsuranceModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->getAllData();
    }

    /**
     * Create a new data in the database
     *
     * @throws UnauthorizedException
     */
    public function create(array $attributes) {
        if (!$this->isAdmin()) throw new UnauthorizedException();

        return $this->createData($attributes);
    }

    /**
     * Get a data from the database by id
     *
     * @param int $id
     * @return TravelInsuranceModel|Collection
     * @throws UnauthorizedException
     */
    public function getById(int $id): TravelInsuranceModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return $this->getByIdentity($id);
    }

    /**
     * Update a specific data in the database
     *
     * @param array $attributes
     * @param int $id
     * @return TravelInsuranceModel|Collection
     * @throws UnauthorizedException
     */
    public function update(array $attributes, int $id): TravelInsuranceModel|Collection
    {
        if (!$this->isAdmin()) throw new UnauthorizedException();
        return  $this->updateData($attributes, $id);
    }

    /**
     * Trash a specified data in the database
     *
     * @param int $id
     * @return mixed
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
