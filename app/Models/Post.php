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
        'contact_number',
        'hide_private_info',
        'images',
        'type',
        'status',
        'category_id',
    ];
}
