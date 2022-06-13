<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\User;

class TokenCreator
{
    public function createToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}
