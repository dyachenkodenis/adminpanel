<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class WebComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'page_id',
        'custom_fields_id',
        'widget_id',
    ];
    protected $table = 'web_components';
    public $timestamps = true;

    public function jsonvalue(): Attribute
    {
        return Attribute::make(fn ($value) => json_decode($value), fn ($value) => json_encode($value));
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }


    public function customFields()
    {
        return $this->belongsToMany(CustomField::class);
    }
}

