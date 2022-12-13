<?php

namespace App\Http\Api\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class UserController extends ApiController
{
    /**
     * @param UserLoginRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        $authService = new AuthService();
        return $this->success(['token' => $authService->login($request->getDTO())]);
    }

    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $authService = new AuthService();
        return $this->success(['token' => $authService->register($request->getDTO())]);
    }
}
