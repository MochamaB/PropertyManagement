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
        'prefix',
        'billcycle',
        'rate',
        'create_invoice',
        'parent_utility',

    ];

    public function readings()
    {
        return $this->hasMany(Readings::class,'utilitycategory_id');
    }

    public function children()
{
    return $this->hasMany(Utilitycategories::class, 'parent_utility');
}

public function parent()
{
    return $this->belongsTo(Utilitycategories::class, 'parent_utility');
}

}
