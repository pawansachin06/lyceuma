<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTable extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'table', 'exam_class_id', 'exam_subject_id',
    ];
}
