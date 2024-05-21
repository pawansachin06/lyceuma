<?php

namespace App\Models;

// use App\Traits\UuidTrait;

use App\Traits\DynamicTableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    use DynamicTableTrait;
    // use UuidTrait; // Table is dynamic so can not use Uuid

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [];

    protected $casts = [];

    // public function courses()
    // {
    //     $question_id = $this->table . '__' . $this->id;
    //     return $this->belongsToMany(Course::class, 'question_pivot_course', 'question_id', 'course_id');
    // }
}
