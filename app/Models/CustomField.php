<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang',
        'page_id',
        'web_components_id',
        'jsonvalue',
    ];
    protected $table = 'custom_fields';
    public $timestamps = true;

    public function jsonvalue(): Attribute
    {
        return Attribute::make(fn ($value) => json_decode($value), fn ($value) => json_encode($value));
    }

    public function page()
    {
        return $this->hasMany(Page::class);
    }

    public function web_components()
    {
        return $this->hasMany(CustomField::class);
    }
}
