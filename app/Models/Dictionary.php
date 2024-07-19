<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dictionary extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'word',
        'transcription',
        'translate',
    ];
    protected $table = 'dictionary';
    public $timestamps = true;
}
 