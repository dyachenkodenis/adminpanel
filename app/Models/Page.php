<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
     use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'status',
        'slug',
        'template',
        'custom_fields_id',
        'web_components_id',
        'jsonvalue',
    ];
    protected $table = 'pages';
    public $timestamps = true;

    public function jsonvalue(): Attribute
    {
        return Attribute::make(fn ($value) => json_decode($value), fn ($value) => json_encode($value));
    }

    public function web_components()
    {
        return $this->hasMany(WebComponent::class);
    }

    public function custom_fields()
    {
        return $this->hasMany(CustomField::class);
    }

}
