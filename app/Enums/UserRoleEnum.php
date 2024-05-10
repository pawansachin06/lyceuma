<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case SUPERADMIN = 'SUPERADMIN';
    case ADMIN      = 'ADMIN';
    case EDITOR     = 'EDITOR';
    case STUDENT    = 'STUDENT';
    // case TEACHER    = 'TEACHER';

    public static function toArray() : array {
        $arr = [];
        foreach(self::cases() as $case) {
            $arr[$case->value] = $case->name;
        }
        return $arr;
    }
}
