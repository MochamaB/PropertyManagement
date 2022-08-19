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
           'invoiceno',
            'paymenttype_id',
            'receiptno',
            'reviewed_by',
            'amountpaid',
           'received_by',
          
            
    ];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    } 
}
