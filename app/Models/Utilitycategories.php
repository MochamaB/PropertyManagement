<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilitycategories extends Model
{
       use HasFactory;
    protected $table = 'utilitycategory';
    protected $fillable = [
        'name',
        'billcycle',
        'rate',
        'create_invoice',

    ];
}
