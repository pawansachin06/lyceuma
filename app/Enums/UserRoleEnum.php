<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case SUPERADMIN = 'SUPERADMIN';
    case ADMIN      = 'ADMIN';
    case EDITOR     = 'EDITOR';
    case TEACHER    = 'TEACHER';
    case STUDENT    = 'STUDENT';

    public static function toArray() : array {
        $arr = [];
        foreach(self::cases() as $case) {
            $arr[$case->value] = $case->name;
        }
        return $arr;
    }
}
