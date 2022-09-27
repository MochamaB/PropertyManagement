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
}
