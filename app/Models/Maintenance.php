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
        'userrequest_id',
        'maintenanceno',
        'priority',
        'billtype',
        'title',
        'description',
        'raisedby',
      
    ];

    public function leases(){

        return $this->belongsTo(Lease::class,'lease_id');
    }

    public function houses()
    {
        return $this->hasOneThrough(House::class,Lease::class,'id','id','lease_id','house_id');
    } 

    public function tenants()
    {
        return $this->hasOneThrough(Tenant::class,Lease::class,'id','id','lease_id','tenant_id');
    }
    public function apartments()
    {
        return $this->hasOneThrough(Apartment::class,Lease::class,'id','id','lease_id','apartment_id');
    }
    public function repairwork()
    {
        return $this->hasOne(Repairwork::class,'maintenance_id');
    }
}
