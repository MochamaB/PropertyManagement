<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Housecategories extends Model
{
    use HasFactory;
    protected $table = 'housecategories';
    protected $fillable = [
        'apartment_id',
        'type',
        'price',
        'rent',
        'setdeposit',
        'description',
    ];
    

    public function apartment()
    {
        return $this->belongsTo(Apartment::class,'apartment_id');
    } 

    public function scopeFilterByUSerRole($query, $userrole)
    {
        
        if (Auth::user()->id != 1) {
        return $query->where('apartment_id',$userrole);
        }
        
    }
}
