<?php

namespace App\Models;

use App\Enums\ModelStatusEnum;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'table', 'exam_category_id', 'exam_type_id', 'duration', 'date',
        'start_time', 'end_time', 'order', 'status',
    ];

    protected $casts = [
        'status' => ModelStatusEnum::class,
        'duration' => 'integer',
        'date' => 'date',
    ];

    public function type()
    {
        return $this->hasOne(ExamType::class, 'id', 'exam_type_id');
    }

    public function category()
    {
        return $this->hasOne(ExamCategory::class, 'id', 'exam_category_id');
    }

    public function classes()
    {
        return $this->belongsToMany(ExamClass::class, 'exam_pivot_exam_class', 'exam_id', 'exam_class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(ExamSubject::class, 'exam_pivot_exam_subject', 'exam_id', 'exam_subject_id');
    }

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
