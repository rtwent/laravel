<?php

declare(strict_types=1);

namespace App\Repositories\Specification;

use App\Dto\CredentialsDto;
use App\Models\User;

/**
 * Уровень абстракции для более сложных проектов
 * На данный момент идет простое использоваение возможностей eloquent - без фич, специфичных для серверов БД
 * И без разделения на чтение и запись
 */
interface IUserRepository
{
    /**
     * @param CredentialsDto $credentials
     * @return User
     */
    public function create(CredentialsDto $credentials): User;

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User;
}
