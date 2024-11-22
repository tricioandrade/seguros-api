<?php

namespace App\Http\Controllers\Client;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Controller;
use App\Exceptions\Auth\UnauthorizedException;
use App\Http\Requests\Client\ClientRequest;
use App\Http\Requests\Users\UserRequest;
use App\Http\Resources\Client\ClientResource;
use App\Services\Client\ClientService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientController extends Controller
{

    public function __construct(
        public ClientService $clientService
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws UnauthorizedException
     */
    public function index(): AnonymousResourceCollection
    {
        return ClientResource::collection($this->clientService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientRequest $clientRequest
     * @param UserRequest $userRequest
     * @return ClientResource
     * @throws DatabaseException
     */
    public function store(ClientRequest $clientRequest, UserRequest $userRequest): ClientResource
    {
        $clientRequest->validated($clientRequest->all());
        $userRequest->validated($userRequest->all());

        $client = $this->clientService->create($clientRequest->all(), $userRequest->all());
        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ClientResource
     * @throws UnauthorizedException
     */
    public function show(int $id): ClientResource
    {
        $client = $this->clientService->getById($id);
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientRequest $clientRequest
     * @param UserRequest $userRequest
     * @param int $clientId
     * @return ClientResource
     * @throws DatabaseException
     * @throws UnauthorizedException
     */
    public function update(
        ClientRequest $clientRequest,
        UserRequest $userRequest,
        int $clientId
    ): ClientResource
    {
        $clientRequest->validated($clientRequest->all());
        $userRequest->validated($userRequest->all());

        $client = $this->clientService->update(
            $clientRequest->all(),
            $userRequest->all(),
            $clientId
        );

        return new ClientResource($client);
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
        return $this->clientService->delete($id);
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
        return $this->clientService->forceDelete($id);
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
        return $this->clientService->restore($id);
    }
}
