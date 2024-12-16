<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActorSlide extends Model
{
    protected $table = 'actor_slides';
    protected $fillable = [
        'id',
        'name',
        'image_name',
        'image_art',
        'image_skill',
        'image_hover',
        'content',
    ];
}
