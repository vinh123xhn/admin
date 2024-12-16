<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';
    protected $fillable = [
        'id',
        'voucher_name',
        'voucher_code',
        'voucher_discount',
        'create_by',
        'update_by',
        'delete_yn',
        'update_at',
    ];
}
