<?php

namespace App\Enums;

class UserRoleEnum
{
    public const SUPER_ADMIN = 1;

    public const USER = 2;

    public static function AllEnumArrayValues(): array
    {
        return [
            static::SUPER_ADMIN,
            static::USER,
        ];
    }

    public static function GetEnumsNameByValue(int $id): string
    {
        return match ($id) {
            static::SUPER_ADMIN => 'SUPER ADMIN',
            static::USER => 'USER',
        };
    }

 public static function Names(): array
 {
     return [
         static::GetEnumsNameByValue(static::SUPER_ADMIN),
         static::GetEnumsNameByValue(static::USER),
     ];
 }

    public static function GetEnumsKeyByName(string $name): int
    {
        return match ($name) {
            'SUPER ADMIN' => static::SUPER_ADMIN,
            'USER' => static::USER,
        };
    }
}
