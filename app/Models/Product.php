<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Product extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['title', 'category_id', 'template', 'widget', 'status', 'slug', 'jsonvalue'];

    protected $table = 'products';
    
    public $timestamps = true;

    public function jsonvalue(): Attribute
    {
        return Attribute::make(fn ($value) => json_decode($value), fn ($value) => json_encode($value));
    }

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
}
