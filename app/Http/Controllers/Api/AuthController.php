<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Services\Api\AuthService;
use App\Traits\JsonResponser;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use JsonResponser;

    public function __construct(protected AuthService $service) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->service->loginHandler($request->validated());

        return $this->success($result, 'Logged In Successfully', Response::HTTP_OK);
    }

    public function logout(): JsonResponse
    {
        if ($this->service->logoutHandler())
            return $this->success(null, 'Logged Out Successfully', Response::HTTP_OK);
    }
}
