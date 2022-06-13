<?php

namespace App\Rules;

use App\Enums\LanguagesIso;
use Illuminate\Contracts\Validation\Rule;

class Languages implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $languages = LanguagesIso::combinedValues();

        return isset($languages[$value]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Language is not correct. We use ISO for languages';
    }
}
