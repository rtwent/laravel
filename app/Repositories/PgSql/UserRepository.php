<?php
declare(strict_types=1);

namespace App\Repositories\PgSql;

use App\Dto\CredentialsDto;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\Specification\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

final class UserRepository implements IUserRepository
{

    public function create(CredentialsDto $credentials): User
    {
        return DB::transaction(function () use ($credentials) {
            $user = User::create([
                'name' => '',
                'email' => $credentials->getEmail(),
                'password' => Hash::make($credentials->getPassword()),
            ]);

            Profile::create([
                'user_id' => $user->id,
                'timezone' => 'Europe/London',
            ]);

            return $user;
        });
    }

    public function findByEmail(string $email): User
    {
        return User::where('email', $email)->firstOrFail();
    }
}
