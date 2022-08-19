<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymenttypes extends Model
{
    use HasFactory;
    protected $table = 'paymenttypes';
    protected $fillable = [
            'paymentname',
            'accountnumber',
            'accountname',
            'code',
            'bank',
            
    ];
}
