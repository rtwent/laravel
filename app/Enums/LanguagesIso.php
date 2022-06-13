<?php
declare(strict_types=1);

namespace App\Enums;

enum LanguagesIso: string
{
    const DEFAULT_LANG = 'UA';

    case UA = 'UA';
    case RU = 'RU';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function combinedValues(): array
    {
        return array_combine(self::values(), self::values());
    }
}
