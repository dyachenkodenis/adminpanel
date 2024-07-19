<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
   use HasFactory, SoftDeletes;
    protected $fillable = [      
        'key',
        'value'       
    ];
    protected $table = 'field';
    public $timestamps = true;

   
}