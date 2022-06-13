<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;
use App\Rules\Languages;
use App\Rules\Timezones;

final class ProfileRequest extends ApiFormRequest
{

    public function authorize(): bool
    {
        // we do not need here to change some permissions yet
        return true;
    }

    public function rules(): array
    {
        return [
            'timezone' => [
                'string',
                'max:255',
                new Timezones()
            ],
            'language' => [
                'string',
                'max:3',
                'min:2',
                new Languages()
            ],
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
