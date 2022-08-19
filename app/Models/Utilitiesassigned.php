<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilitiesassigned extends Model
{
    use HasFactory;
     protected $table = 'Utilitiesassigned';
     protected $fillable = [
        'leaseno',
        'utilitycategoryid',
    ];
     /**
     * Get the lease that owns the utilities.
     */
    public function lease()
    {
        return $this->belongsTo(Lease::class,'leaseno');
    }
}

