<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Dto\AccessTokenDto;
use App\Dto\CredentialsDto;
use App\Repositories\Specification\IUserRepository;
use App\Services\Specification\Auth\IRegister;

final class Register implements IRegister
{
    private IUserRepository $repository;

    private TokenCreator $tokenCreator;

    /**
     * @param IUserRepository $repository
     * @param TokenCreator $tokenCreator
     */
    public function __construct(IUserRepository $repository, TokenCreator $tokenCreator)
    {
        $this->repository = $repository;
        $this->tokenCreator = $tokenCreator;
    }


    public function register(CredentialsDto $credentials): AccessTokenDto
    {
        $user = $this->repository->create($credentials);

        return new AccessTokenDto(
            $this->tokenCreator->createToken($user),
            time() + (config('sanctum.expiration') * 60)
        );
    }

}
