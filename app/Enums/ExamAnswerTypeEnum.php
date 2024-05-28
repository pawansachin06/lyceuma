<?php

namespace App\Enums;

enum ExamAnswerTypeEnum: string
{
    case RADIO     = 'RADIO';
    case CHECKBOX  = 'CHECKBOX';
    case INTEGERS  = 'INTEGER';
    case FLOATING  = 'FLOATING';
    case FILE      = 'FILE';

    case PASSAGE   = 'PASSAGE';
    case MATRIX2   = 'MATRIX2';
    case MATRIX3   = 'MATRIX3';
    case STEM      = 'STEM';
    case STATEMENT = 'STATEMENT';

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

        $arr[] = ['key'=> 'STEM', 'value'=> 'Stem-type Numerical'];
        $arr[] = ['key'=> 'PASSAGE', 'value'=> 'Passage Type'];
        $arr[] = ['key'=> 'MATRIX2', 'value'=> 'Two-column Matrix matching'];
        $arr[] = ['key'=> 'MATRIX3', 'value'=> 'Three-column Matrix matching'];
        $arr[] = ['key'=> 'STATEMENT', 'value'=> 'Assertion/Statement Type'];

        return $arr;
    }
}
