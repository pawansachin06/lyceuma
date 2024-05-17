<?php

namespace App\Models;

use App\Enums\ModelStatusEnum;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'slug', 'status', 'subject_id', 'parent_id',
    ];

    protected $casts = [
        'status' => ModelStatusEnum::class,
    ];

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function topics()
    {
        return $this->hasMany(Chapter::class, 'parent_id', 'id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'parent_id', 'id');
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
