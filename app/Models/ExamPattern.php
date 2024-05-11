<?php

namespace App\Models;

use App\Enums\ModelStatusEnum;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPattern extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'exam_type_id', 'status'
    ];

    protected $casts = [
        'status' => ModelStatusEnum::class,
    ];

    public function isStatus($askedStatus = '')
    {
        return $this->status->value == $askedStatus;
    }

    public function type()
    {
        return $this->hasOne(ExamType::class, 'id', 'exam_type_id');
    }
}
