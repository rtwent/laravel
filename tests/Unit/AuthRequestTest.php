<?php

namespace Tests\Unit;

use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Support\Facades\Validator;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

/**
 * Пример для валидации реквеста
 */
class AuthRequestTest extends TestCase
{
    /**
     * Не трогаем некоторые виды проверок
     * Которые могут быть связаны с БД
     *
     * @var array|string[]
     */
    private array $skippedFilters = ['|exists:users'];

    public function setUp(): void
    {
        parent::setUp();

        $this->rules = (new AuthRequest())->rules();
        $this->validator = $this->app[Validator::class];
    }

    /**
     * Check a field and value against validation rule
     *
     * @param string $field
     * @param mixed $value
     * @return bool
     */
    protected function validateField(string $field, $value): bool
    {
        return $this->validator::make(
            [$field => $value],
            [$field => str_replace(['|exists:users'], '', $this->rules[$field])]
        )->passes();
    }

    /**
     * A basic unit test example.
     * @return void
     * @todo Could be done via dataprovider
     *
     */
    public function test_example()
    {
        $this->assertTrue($this->validateField('email', 'somemail@ukr.net'));
        $this->assertTrue($this->validateField('password', 'xxxxxxxxxx'));

        $this->assertFalse($this->validateField('email', 'r22ukr.net'));
        $this->assertFalse($this->validateField('password', 'xx'));
    }
}
