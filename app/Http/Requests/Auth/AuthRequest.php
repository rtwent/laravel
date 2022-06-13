<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

final class AuthRequest extends ApiFormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|exists:users',
            'password' => 'required|string|max:12|min:8',
        ];
    }

    public function messages()
    {
        return [
            parent::messages(),
            ...[
                'email.exists' => 'Combination of email and password was not found'
            ]
        ];
    }

}
