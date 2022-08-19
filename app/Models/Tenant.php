<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


class Tenant extends Model
{
    use HasFactory;
    protected $table = 'tenants';
    protected $fillable = [
            'user_id',
            'idnumber',
            'firstname',
            'lastname',
            'email',
            'phonenumber',
            'occupation',
            'company',
            'emergencyname',
            'emergencynumber',
            'status',
            'apartment_id',
       
    ];

//////////////  Defined Eloquent Relationships///////////////////////////

    public function apartment()
    {
        return $this->belongsTo(Apartment::class,'apartment_id');
    } 

     public function house()
    {
        return $this->hasOne(House::class);
    }
    public function lease()
    {
        return $this->belongsto(lease::class,'status1');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('tenant_id')->withTimestamps();
    }

///////////////////////// Scope functions /////////////////////////////////////
    public function scopeFilterByUSerAccess($query)
    {
        $useraccess = Auth::user()->id;
        if (Auth::user()->id != 1) {
            
            return $query->Join('tenant_user','tenants.id','=','tenant_user.tenant_id')
                ->where('tenant_user.user_id',$useraccess);
            }
        
    }
    public function scopeFilterByUSerRole($query, $userrole)
    {
        $userrole = Auth::user()->id;
        if (Auth::user()->id != 1) {
            
            return $query->where('apartment_id',$userrole);
            }
        
    }
    public function scopeFilterByAdmin($query)
    {
        
        if (Auth::user()->id != 1) {
            
            return $query->Join('tenant_user','tenants.id','=','tenant_user.tenant_id')
                ->where('tenant_user.user_id',Auth::user()->id);
            }
        
    }
   
        
    
    

}
