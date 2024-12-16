<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'id',
        'title',
        'content',
        'create_by',
        'update_by',
        'delete_yn',
        'update_at',
    ];
}
