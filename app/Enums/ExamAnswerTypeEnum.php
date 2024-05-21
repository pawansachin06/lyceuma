<?php

namespace App\Enums;

enum ExamAnswerTypeEnum: string
{
    case RADIO    = 'RADIO';
    case CHECKBOX = 'CHECKBOX';
    case INTEGERS   = 'INTEGER';
    case PASSAGE   = 'TEXTAREA';
    case STRINGS   = 'STRING';

    public static function toArray() : array {
        $arr = [];
        foreach(self::cases() as $case) {
            $arr[$case->value] = $case->name;
        }
        return $arr;
    }

    public static function toFormattedArray() : array {
        $arr = [];
        $arr[] = ['key'=> 'RADIO', 'value'=> 'Single Choice'];
        $arr[] = ['key'=> 'CHECKBOX', 'value'=> 'Multiple Choice'];
        $arr[] = ['key'=> 'INTEGER', 'value'=> 'Integer Type'];
        $arr[] = ['key'=> 'TEXTAREA', 'value'=> 'Passage Type'];
        $arr[] = ['key'=> 'STRING', 'value'=> 'Stem-type Type'];
        return $arr;
    }
}
