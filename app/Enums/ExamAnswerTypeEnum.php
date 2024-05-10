<?php

namespace App\Enums;

enum ExamAnswerTypeEnum: string
{
    case NUMBER   = 'NUMBER';
    case RADIO    = 'RADIO';
    // case CHECKBOX = 'CHECKBOX';

    public static function toArray() : array {
        $arr = [];
        foreach(self::cases() as $case) {
            $arr[$case->value] = $case->name;
        }
        return $arr;
    }
}
