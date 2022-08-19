<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilitypayments extends Model
{
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
    use HasFactory;
    protected $table = 'utilitypayments';
    protected $fillable = [
            'leaseID',
            'utilityinvoiceno',
            'utilitycategoryid',
            'utilityamountdue',
            'utilityamountpaid',
            'created_at',
            'duedate',

    ];

}
