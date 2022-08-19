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
        'invoicetype',
        'amountdue',
        'invoicedate',
        'raised_by',
        'status',
        'expensetype',
        'duedate',
        'reviewed_by',
    ];

    
    public function payments()
    {
        return $this->hasMany(Payments::class,'invoice_id');
    }
    public function monthSums() {

        return $this->hasMany(Payments::class)->selectRaw('sum(amountdue) as sum_amount');
    }

    public function scopeFilterByInvoiceitem($query,$invoicetype)
    {
        
            return $query->whereInvoiceitem($invoicetype);
            
    }
    
}
