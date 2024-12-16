<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageLauncher extends Model
{
    protected $table = 'image_launcher';
    protected $fillable = [
        'id',
        'image',
        'type',
        'link'
    ];
}
