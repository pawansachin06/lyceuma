<?php

namespace App\Models;

use App\Enums\ModelStatusEnum;
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
        'name', 'status', 'exam_subject_id', 'parent_id',
    ];

    protected $casts = [
        'status' => ModelStatusEnum::class,
    ];

    public function subject()
    {
        return $this->hasOne(ExamSubject::class, 'id', 'exam_subject_id');
    }

    public function topics()
    {
        return $this->hasMany(ExamChapter::class, 'parent_id', 'id');
    }

    public function chapter()
    {
        return $this->belongsTo(ExamChapter::class, 'parent_id', 'id');
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
