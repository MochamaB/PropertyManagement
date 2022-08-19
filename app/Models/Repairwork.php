<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repairwork extends Model
{
    use HasFactory;
    protected $table = 'repairwork';
    protected $fillable = [
        'maintenance_id',
        'Workid',
        'dateofrepair',
        'suppliesused',
        'descworkdone',
        'recommendations',
        'amountspent',
        'amountpaid',
        'status',
        'assignedto',
        'assignedby',
       
        
    ];
}
