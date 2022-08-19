<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $table = 'maintenance';
    protected $fillable = [
        'lease_id',
        'maintenanceno',
        'priority',
        'billtype',
        'name',
        'description',
        'raisedby',
      
    ];
}
