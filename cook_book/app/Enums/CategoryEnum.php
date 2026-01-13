<?php

namespace App\Enums;

enum CategoryEnum: string
{
    case PLAT = 'plat';
    case DESSERT = 'dessert';
    case BOISSON = 'boisson';

    public function label(): string
    {
        return match ($this) {
            self::PLAT => 'Plat',
            self::DESSERT => 'Dessert',
            self::BOISSON => 'Boisson',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
