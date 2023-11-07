<?php

namespace App\Services\Auth;

use App\Exceptions\Auth\LoginInvalidException;
use App\Exceptions\Auth\SessionRequestException;
use App\Exceptions\Auth\UserBlockedException;
use App\Models\Company\EmployeeModel;
use App\Services\Employee\EmployeeService;
use App\Traits\Common\Auth\VerifyUserTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use VerifyUserTrait;

    public function __construct(
        public EmployeeService $employeeService
    ){}

    /**
     * Create a new login instance
     *
     * @param array $credentials
     * @return Collection|EmployeeModel
     * @throws LoginInvalidException
     * @throws SessionRequestException
     * @throws UserBlockedException
     */
    public function login(array $credentials): Collection|EmployeeModel
    {
        if (Auth::check()) throw new SessionRequestException();
        if (!Auth::attempt($credentials)) throw new LoginInvalidException();

        if ($this->isBlocked()) {
            $this->logout();
            throw new UserBlockedException();
        }

        request()->session()->regenerate();

        $me = $this->employeeService->me();
        $me->login_times += 1;
        $me->save();
        $me->token = $me->createToken($me->name . ' api token')->plainTextToken;

        return $me;
    }

    /**
     * Logout, end of session
     *
     * @return void
     */
    public function logout(): void
    {
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
