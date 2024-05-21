<?php

namespace App\Enums;

enum ExamAnswerTypeEnum: string
{
    case RADIO     = 'RADIO';
    case CHECKBOX  = 'CHECKBOX';
    case INTEGERS  = 'INTEGER';
    case PASSAGE   = 'TEXTAREA';
    case STRINGS   = 'STRING';
    case STATEMENT = 'STATEMENT';
    case MATRIX2   = 'MATRIX2';
    case MATRIX3   = 'MATRIX3';

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
        $arr[] = ['key'=> 'TEXTAREA', 'value'=> 'Passage'];
        $arr[] = ['key'=> 'STRING', 'value'=> 'Stem-type'];
        $arr[] = ['key'=> 'STATEMENT', 'value'=> 'Assertion/Statement'];
        $arr[] = ['key'=> 'MATRIX2', 'value'=> 'Two-column Matrix matching'];
        $arr[] = ['key'=> 'MATRIX3', 'value'=> 'Three-column Matrix Matching'];

        return $arr;
    }
}
