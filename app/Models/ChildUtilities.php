<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildUtilities extends Model
{
    use HasFactory;
    protected $table = 'childutilities';
    protected $fillable = [
        'invoice_id',
        'utilitycategory_id',
        'lease_id',
        'invoiceno',
        'chldamountdue',
   
];
}
