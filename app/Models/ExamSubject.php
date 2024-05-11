<?php

namespace App\Models;

use App\Enums\ModelStatusEnum;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'status',
    ];

    protected $casts = [
        'status' => ModelStatusEnum::class,
    ];

    public function isStatus($askedStatus = '')
    {
        return $this->status->value == $askedStatus;
    }
}
