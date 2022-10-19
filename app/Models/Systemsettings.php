<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systemsettings extends Model
{
    use HasFactory;
    protected $table = 'systemsettings';
    protected $fillable = [
        'systemname', 'companyname', 'phonenumber','email', 'logo', 'postal_code','location',
        'terms_and_conditions','automate_invoice'
    ];
}
