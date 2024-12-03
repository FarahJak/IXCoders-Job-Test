<?php

namespace App\Services\Api;

use App\Http\Resources\Users\LoginResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use JsonException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthService
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function loginHandler(array $data)
    {
        $user =  $this->model::Where('email', $data['email'])->first();

        if ($user) {
            if (Hash::check($data['password'], $user->password)) {

                $token = $user->createToken($user->email)->plainTextToken;

                $result = [
                    'token'      => $token,
                    'admin'      => new LoginResource($user)
                ];

                return $result;
            } else {
                throw new AuthenticationException();
            }
        } else {
            throw new NotFoundHttpException();
        }
    }

    public function logoutHandler()
    {
        $user = request()->user('users');

        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return true;
    }
}
