<?php

namespace App\Models;

// use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    // use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [];

    protected $casts = [];
}
