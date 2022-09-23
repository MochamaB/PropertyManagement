<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $table = 'apartment';
    protected $fillable = [
        'apartmentno',
        'email',
        'postalcode',
        'tel',
        'logo',
        'location',
        'authorized_person',
        'signature_photo',
        
    ];

    //////////////  Defined Eloquent Relationships///////////////////////////

    public function housecategories()
    {
        return $this->hasMany(Housecategories::class,'apartment_id');
    }
    public function house()
    {
        return $this->hasManyThrough(House::class, Housecategories::class,'apartment_id','housecategoryid','id','id');
    }

    public function tenant()
    {
        return $this->hasMany(Tenant::class,'apartment_id');
    }
}
