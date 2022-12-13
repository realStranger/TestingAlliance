<?php

namespace App\Services;

use App\DTO\UserLoginDTO;
use App\DTO\UserRegisterDTO;
use App\Exceptions\ApiException;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    private User|null $user;
    private string $token;


    /**
     * @param UserLoginDTO $dto
     * @return string
     * @throws ApiException
     */
    public function login(UserLoginDTO $dto): string
    {
        $this->user = User::firstWhere('email', $dto->getEmail());

        if (empty($this->user)) {
            throw new ApiException('User not found', ApiException::VALIDATION_ERROR, 422);
        }

        if(Hash::check($dto->getPassword(), $this->user->password)) {
            $this->token = $this->generateToken();
            $this->updateUserToken();
        } else {
            throw new ApiException('Wrong password', ApiException::VALIDATION_ERROR, 422);
        }

        return $this->token;
    }

    /**
     * @param UserRegisterDTO $dto
     * @return string
     * @throws ApiException
     */
    public function register(UserRegisterDTO $dto): string
    {
        $user = User::firstWhere('email', $dto->getEmail());

        if (!empty($user)) {
            throw new ApiException('User with this email exists', ApiException::VALIDATION_ERROR, 422);
        }

        $this->user = User::create([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => bcrypt($dto->getPassword()),
        ]);

        $this->token = $this->generateToken();

        $this->createUserToken();

        return $this->token;
    }

    /**
     * @return void
     */
    private function createUserToken():void
    {
        UserToken::create([
            'user_id' => $this->user->id,
            'token' => $this->token
        ]);
    }

    /**
     * @return void
     */
    private function updateUserToken():void
    {
        $userToken = UserToken::where('user_id', $this->user->id)->firstOrFail();
        $userToken->update([
            'user_id' => $this->user->id,
            'token' => $this->token
        ]);
    }

    /**
     * @return string
     */
    private function generateToken(): string
    {
        return Str::random(255);
    }
}
