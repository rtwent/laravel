<?php
declare(strict_types=1);

namespace App\Dto;

use Illuminate\Contracts\Support\Arrayable;

final class AccessTokenDto implements Arrayable
{
    private string $token;
    private int $till;
    private string $type = 'Bearer';

    /**
     * @param string $token
     * @param int $till
     * @param string $type
     */
    public function __construct(string $token, int $till, string $type = 'Bearer')
    {
        $this->token = $token;
        $this->till = $till;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return int
     */
    public function getTill(): int
    {
        return $this->till;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Will help us to serialize this object when create new Illuminate\Http\JsonResponse
     * @return array
     */
    public function toArray(): array
    {
        return [
            'token' => $this->getToken(),
            'till' => $this->getTill(),
            'type' => $this->getType()
        ];
    }

}
