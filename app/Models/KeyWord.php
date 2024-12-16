<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeyWord extends Model
{
    protected $table = 'key_words';
    protected $fillable = [
        'id',
        'keyword',
    ];
}
