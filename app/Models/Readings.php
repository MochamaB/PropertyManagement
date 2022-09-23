<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Readings extends Model
{
    use HasFactory;
     protected $table = 'readings';
    protected $fillable = [
        'utilitycategory_id',
        'lease_id',
        'meternumber',
        'recordno',
        'initialreading',
        'lastreading',
        'currentreading',
        'amountdue',
        'fromdate',
        'todate',
        'recorded_by',
        
    ];

    public function utilitycategory()
    {
        return $this->belongsTo(Utilitycategories::class,'utilitycategory_id');
    } 
    public function lease()
    {
        return $this->belongsTo(Lease::class,'lease_id');
    } 
}
