<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamChapter extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'status', 'exam_subject_id', 'exam_chapter_id',
        'exam_difficulty_id',
    ];

    public function subject()
    {
        return $this->hasOne(ExamSubject::class, 'id', 'exam_subject_id');
    }

    public function difficulty()
    {
        return $this->hasOne(ExamDifficulty::class, 'id', 'exam_difficulty_id');
    }
}
