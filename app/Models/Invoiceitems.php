<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoiceitems extends Model
{
    use HasFactory;
    protected $table = 'invoiceitems';
    protected $fillable = [
        'invoice_id',
        'invoiceno',
        'itemname',
        'amountdue',
    ];

      public function invoice()
    {
         return $this->belongsTo(Invoice::class);
    }

}
