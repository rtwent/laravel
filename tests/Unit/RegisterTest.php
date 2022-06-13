<?php

namespace Tests\Unit;

use App\Dto\AccessTokenDto;
use App\Dto\CredentialsDto;
use App\Models\User;
use App\Repositories\Specification\IUserRepository;
use App\Services\Auth\Register;
use App\Services\Auth\TokenCreator;
use App\Services\Specification\Auth\IRegister;

//use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\Support\Arrayable;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    private IUserRepository $repository;

    private TokenCreator $tokenCreator;

    private IRegister $registerInstance;

    private CredentialsDto $credentials;

    private const TOKEN = 'some_random_token';

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->createMock(IUserRepository::class);
        $this->tokenCreator = $this->createMock(TokenCreator::class);
        $this->registerInstance = new Register($this->repository, $this->tokenCreator);
        $this->credentials = new CredentialsDto('user@email', 'password');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_IdealCase()
    {
        $this->repository->method('create')->willReturn(User::factory()->make());
        $this->tokenCreator->method('createToken')->willReturn(self::TOKEN);
        $result = $this->registerInstance->register($this->credentials);

        $this->assertInstanceOf(AccessTokenDto::class, $result);
        $this->assertInstanceOf(Arrayable::class, $result);
        $this->assertEquals(self::TOKEN, $result->getToken());
        $this->assertCount(3, $result->toArray());
    }

    public function test_DbWentWrong()
    {
        $this->repository->method('create')->willThrowException(new \Exception('Db went wrong'));

        $this->expectException(\Exception::class);
        $this->registerInstance->register($this->credentials);
    }

    public function test_TokenCreatorFailed()
    {
        $this->tokenCreator->method('createToken')->willThrowException(new \Exception('Db went wrong'));

        $this->expectException(\Exception::class);
        $this->registerInstance->register($this->credentials);
    }
}
