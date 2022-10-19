<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Lease extends Model
{
    use HasFactory;
    protected $table = 'lease';
    protected $fillable = [
        'apartment_id',
        'house_id',
        'tenant_id',
        'leaseno',
        'actualdeposit',
        'actualrent',
        'status',
        'terms',
        
    ];


    public function house(){

        return $this->hasOne(House::class,'id');
    }
    public function tenant(){

        return $this->hasOne(Tenant::class,'id');
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class,'apartment_id');
    } 

    public function readings()
    {
        return $this->hasMany(Readings::class,'lease_id');
    } 
    public function invoices()
    {
        return $this->hasMany(Invoice::class,'lease_id');
    } 

    ///////////////////////
    public function scopeFilterByAdmin($query)
    {
        if (Auth::user()->id != 1) {
            
            return $query->where('apartment_id',Auth::user()->apartment_id);
            }      
    }

   
    public function scopeFilterByHouseAccess($query)
    {
        if (Auth::user()->id != 1) {
            
            return $query->Join('houses','houses.id','=','lease.house_id')
            ->Join('house_user','houses.id','=','house_user.house_id')
            ->join('tenants','tenants.id','=','lease.tenant_id')
            ->where('house_user.user_id',Auth::user()->id);
        }
          
    
        
    }
    public function scopeFilterReadings($query,$fromdate)
    {
       $billcycle = Utilitycategories::get();
       if($billcycle->billcycycle = 'Units'){
        return $query->leftjoin('readings','readings.lease_id', '=', 'lease.id')
                     ->where('readings.fromdate',$fromdate)
                    ->addSelect('readings.lease_id','readings.amountdue');
       }
    }
    



}
