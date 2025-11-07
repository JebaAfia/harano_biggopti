<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'hidden_proof',
        'occurrence_date',
        'occurrence_time',
        'location',
        'geo_lat',
        'geo_long',
        'contact_number',
        'hide_private_info',
        'images',
        'type',
        'status',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }
}
