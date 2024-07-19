<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'parent_id', 'status', 'slug', 'jsonvalue'];

    protected $table = 'categories';

    public $timestamps = true;

    public function jsonvalue(): Attribute
    {
        return Attribute::make(fn ($value) => json_decode($value), fn ($value) => json_encode($value));
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
