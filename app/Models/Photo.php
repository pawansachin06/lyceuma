<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    use UuidTrait;

    protected $fillable = [
        'name', 'folder', 'photoable_type',
        'photoable_id', 'tag', 'meta',
    ];

    public function photoable(){
        return $this->morphTo();
    }
}
