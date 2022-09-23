<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Utilitycategories;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = [
        'lease_id',
        'invoiceno',
        'utilitycategory_id',
        'parent_utility',
        'invoicetype',
        'amountdue',
        'invoicedate',
        'raised_by',
        'status',
        'expensetype',
        'duedate',
        'reviewed_by',
    ];

    protected $casts = [
        'parent_utility' => 'array',
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

    public function payments()
    {
        return $this->hasMany(Payments::class,'invoice_id');
    }
    public function utilitycategories() {

        return $this->belongsTo(Utilitycategories::class,'utilitycategory_id');
    }



  


    public function scopeFilterByInvoiceitem($query,$invoicetype)
    {
        
            return $query->whereInvoiceitem($invoicetype);
            
    }
    
}
