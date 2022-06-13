<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Dto\AccessTokenDto;
use App\Dto\CredentialsDto;
use App\Exceptions\Unauthorized;
use App\Repositories\Specification\IUserRepository;
use App\Services\Specification\Auth\ILogin;
use Illuminate\Support\Facades\Auth;

final class Login implements ILogin
{
    private IUserRepository $userRepository;

    private TokenCreator $tokenCreator;

    /**
     * @param IUserRepository $userRepository
     * @param TokenCreator $tokenCreator
     */
    public function __construct(IUserRepository $userRepository, TokenCreator $tokenCreator)
    {
        $this->userRepository = $userRepository;
        $this->tokenCreator = $tokenCreator;
    }


    /**
     * @param CredentialsDto $credentials
     * @return AccessTokenDto
     * @throws Unauthorized
     */
    public function auth(CredentialsDto $credentials): AccessTokenDto
    {
        $user = $this->userRepository->findByEmail($credentials->getEmail());

        $user->tokens()->delete();

        if (!Auth::attempt($credentials->toArray())) {
            throw new Unauthorized('Password or login do not match');
        }

        return new AccessTokenDto(
            $this->tokenCreator->createToken($user),
            time() + (config('sanctum.expiration') * 60)
        );

    }
}
