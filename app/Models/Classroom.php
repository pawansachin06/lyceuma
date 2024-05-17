<?php

namespace App\Models;

use App\Enums\ModelStatusEnum;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'slug', 'status',
    ];

    protected $casts = [
        'status' => ModelStatusEnum::class,
    ];

    // public function exams()
    // {
    //     return $this->belongsToMany(Exam::class, 'exam_pivot_exam_class', 'exam_class_id', 'exam_id');
    // }

    public function isStatus($askedStatus = '')
    {
        return $this->status->value == $askedStatus;
    }

    public function isStatusDraft()
    {
        return $this->status === ModelStatusEnum::DRAFT;
    }

    public function isStatusPublished()
    {
        return $this->status === ModelStatusEnum::PUBLISHED;
    }
}
