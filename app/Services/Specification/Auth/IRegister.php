<?php

namespace App\Services\Specification\Auth;

use App\Dto\AccessTokenDto;
use App\Dto\CredentialsDto;

/**
 * Спецификация по регистрации пользователя.
 * Реализации биндятся на уровне контейнера
 */
interface IRegister
{
    public function register(CredentialsDto $credentials): AccessTokenDto;
}
