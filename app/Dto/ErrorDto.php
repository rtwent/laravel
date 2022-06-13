<?php
declare(strict_types=1);

namespace App\Dto;

use Illuminate\Contracts\Support\Arrayable;

final class ErrorDto implements Arrayable
{
    private string $message;
    private int $code;
    private string $trace;

    /**
     * @param string $message
     * @param int $code
     * @param string $trace
     */
    public function __construct(string $message, int $code, string $trace)
    {
        $this->message = $message;
        $this->code = $code;
        $this->trace = $trace;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getTrace(): string
    {
        return $this->trace;
    }

    public function toArray()
    {
        return [
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
            'trace' => $this->getTrace()
        ];
    }


}
