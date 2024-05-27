<?php

namespace App\Enums;

enum ExamAnswerTypeEnum: string
{
    case RADIO     = 'RADIO';
    case CHECKBOX  = 'CHECKBOX';
    case INTEGERS  = 'INTEGER';
    case FLOATING  = 'FLOATING';
    case FILE      = 'FILE';

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
        $arr[] = ['key'=> 'INTEGER', 'value'=> 'Integer'];
        $arr[] = ['key'=> 'FLOATING', 'value'=> 'Floating-point'];
        $arr[] = ['key'=> 'FILE', 'value'=> 'File Upload (image/pdf)'];

        return $arr;
    }
}
