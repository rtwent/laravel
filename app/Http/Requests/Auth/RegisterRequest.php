<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

final class RegisterRequest extends ApiFormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|string|max:12|min:8',
        ];
    }

}
