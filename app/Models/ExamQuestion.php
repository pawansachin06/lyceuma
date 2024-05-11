<?php

namespace App\Models;

use App\Enums\ExamAnswerTypeEnum;
use App\Enums\ModelStatusEnum;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'status', 'exam_pattern_id', 'exam_difficulty_id',
        'exam_subject_id', 'answer_type', 'correct_answer',
        'question', 'answer1', 'answer2', 'answer3', 'answer4', 'solution',
    ];

    protected $casts = [
        'status' => ModelStatusEnum::class,
        'answer_type' => ExamAnswerTypeEnum::class,
    ];

    public function difficulty()
    {
        return $this->hasOne(ExamDifficulty::class, 'id', 'exam_difficulty_id');
    }

    public function subject()
    {
        return $this->hasOne(ExamSubject::class, 'id', 'exam_subject_id');
    }

    public function pattern()
    {
        return $this->hasOne(ExamPattern::class, 'id', 'exam_pattern_id');
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
