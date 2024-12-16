<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';
    protected $fillable = [
        'id',
        'ticket_name',
        'create_by',
        'update_by',
        'delete_yn',
        'updated_at',
    ];
}
