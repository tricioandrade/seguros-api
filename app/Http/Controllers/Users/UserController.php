<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Users\UserRequest;
use App\Http\Resources\Users\UserResource;
use App\Services\Users\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{

    public function __construct(
        public UserService $userService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection($this->userService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $userRequest
     * @return UserResource
     * @throws UnauthorizedException
     */
    public function store(UserRequest $userRequest): UserResource
    {
        $userRequest->validated($userRequest->all());
        $user = $this->userService->create($userRequest->all());
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return UserResource
     * @throws UnauthorizedException
     */
    public function show(int $id): UserResource
    {
        $user = $this->userService->getById($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $userRequest
     * @param int $id
     * @return UserResource
     * @throws UnauthorizedException
     */
    public function update(UserRequest $userRequest, int $id): UserResource
    {
        $userRequest->validated($userRequest->all());
        $user = $this->userService->update($userRequest->all(), $id);
        return new UserResource($user);
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
        return $this->userService->delete($id);
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
        return $this->userService->forceDelete($id);
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
        return $this->userService->restore($id);
    }
}
