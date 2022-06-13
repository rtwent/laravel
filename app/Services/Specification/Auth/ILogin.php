<?php
declare(strict_types=1);

namespace App\Services\Specification\Auth;

use App\Dto\AccessTokenDto;
use App\Dto\CredentialsDto;
use App\Exceptions\Unauthorized;

interface ILogin
{
    /**
     * @param CredentialsDto $credentials
     * @return AccessTokenDto
     * @throws Unauthorized
     */
    public function auth(CredentialsDto $credentials): AccessTokenDto;
}
