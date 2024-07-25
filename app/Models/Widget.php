<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Widget extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'template',
        'thumbnail',
    ];
    protected $table = 'widget';
    public $timestamps = true;

    public function jsonvalue(): Attribute
    {
        return Attribute::make(fn ($value) => json_decode($value), fn ($value) => json_encode($value));
    }
    public function customFields()
    {
        return $this->hasMany(CustomField::class);
    }
}
