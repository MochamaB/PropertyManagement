<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
     protected $table = 'payments';
    protected $fillable = [
           'invoice_id',
           'lease_id',
           'invoiceno',
            'paymenttype_id',
            'payment_code',
            'receiptno',
            'reviewed_by',
            'amountpaid',
           'received_by',
          
            
    ];
    public function invoices()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    } 
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
