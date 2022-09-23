<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class House extends Model
{
    use HasFactory;
    protected $table = 'houses';
    protected $fillable = [
            'housecategoryid',
            'housenumber',
            'title',
            'description',
            'meternumber',
            'status',
    ];
//////////////// Relationships /////////////////////////////////////////////

    public function housecategories()
    {
        return $this->belongsTo(Housecategories::class,'housecategoryid');
    } 
    public function apartment()
    {
        return $this->hasOneThrough(Apartment::class,Housecategories::class,'id','id','housecategoryid','apartment_id');
    } 

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('house_id')->withTimestamps();
    }

    public function invoices()
    {
        return $this->hasManyThrough(Invoice::class, Lease::class,'house_id','lease_id','id','id');
    }

   ///////////////////// Scope and Filters ////////////////////

    public function scopeFilterByUSerRole($query)
    {
        $userrole = Auth::user()->apartment_id;
        if (Auth::user()->id != 1) {
            return $query->join('housecategories','housecategories.id','=','houses.housecategoryid')
                    ->where('housecategories.apartment_id',$userrole);
            }
        
    }

    public function scopeFilterByUSerAccess($query)
    {
        if (Auth::user()->id != 1) {
            
            return $query->Join('house_user','houses.id','=','house_user.house_id')
                ->where('house_user.user_id',Auth::user()->id);
            }
        
    }

  
}
