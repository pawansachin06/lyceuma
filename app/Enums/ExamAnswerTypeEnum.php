<?php

namespace App\Enums;

enum ExamAnswerTypeEnum: string
{
    case RADIO    = 'RADIO';
    case CHECKBOX = 'CHECKBOX';
    case NUMBER   = 'NUMBER';

    public static function toArray() : array {
        $arr = [];
        foreach(self::cases() as $case) {
            $arr[$case->value] = $case->name;
        }
        return $arr;
    }

    public static function toFormattedArray() : array {
        $arr = [];
        $arr[] = ['key'=> self::RADIO, 'value'=> 'Single Choice'];
        $arr[] = ['key'=> self::CHECKBOX, 'value'=> 'Multiple Choice'];
        $arr[] = ['key'=> self::NUMBER, 'value'=> 'Integer Type'];
        return $arr;
    }
}
