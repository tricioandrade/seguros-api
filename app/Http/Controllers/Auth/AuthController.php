<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\Auth\LoginInvalidException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Company\EmployeeResource;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @param  AuthService $authService
     */
    public function __construct(
        protected AuthService $authService
    ){}

    /**
     * Handle a login attempt.
     *
     * @param LoginRequest $loginRequest
     * @return EmployeeResource
     * @throws LoginInvalidException
     * @throws \Throwable
     */
    public function login(LoginRequest $loginRequest): EmployeeResource
    {
        $loginRequest->validated($loginRequest->all());
        $employee = $this->authService->login($loginRequest->all());

        return new EmployeeResource($employee);
    }

    /**
     * Handle a logout attempt
     *
     * @return void
     */
    public function logout(): void
    {
        $this->authService->logout();
    }
}
