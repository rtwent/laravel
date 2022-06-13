<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DateTimeZone;

class Timezones implements Rule
{
    const DEFAULT_TIMEZONE = 'Europe/London';
    
    private array $timeZones;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->timeZones = $this->timeZonesList();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return isset($this->timeZones[$value]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Timezone is not supported. See https://en.wikipedia.org/wiki/List_of_tz_database_time_zones';
    }

    /**
     * Получаем хеш таблицу вместо массива, чтоб можно было проще искать
     * @return array<string, string>
     */
    private function timeZonesList(): array
    {
        $timeZones = DateTimeZone::listIdentifiers();

        return array_combine($timeZones, $timeZones);
    }
}
