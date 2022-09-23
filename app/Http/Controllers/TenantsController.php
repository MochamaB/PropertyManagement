<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\house;
use App\Models\Apartment;
use App\Models\User;
use App\Models\Lease;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
          
            $managerview = Tenant::FilterByUSerAccess()
                                ->with('apartment')
                                ->select('tenants.id','tenants.*')
                                ->get();
            
            $tenantview = Tenant::where('email',Auth::user()->email)->get();

        return view('tenants.index', compact('tenantview','managerview'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apartment = Apartment::get();
        $house = house::select('id','status','housenumber')->where('status', 'Empty')->get();
         return view('tenants.create', compact('house','apartment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

             $validatedData = $request->validate([
                'idnumber' => 'required|numeric',
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'phonenumber' => 'required|numeric',
                'occupation' => 'required',
                'company' => '',
                'emergencyname' => '',
                'emergencynumber' => ''
            ], [
                'idnumber.required' => 'This field is required',
                'idnumber.numeric' => 'Input Numbers Only',
                'firstname.required'=> 'This field is required',
                'lastname.required' => 'This field is required',
                'email.required' => 'This field is required',
                'phonenumber.required'=> 'This field is required',
                'phonenumber.numeric' => 'Input Numbers only',
                'occupation.required'=> 'This field is required',

            ]);

        $tenantidnumber = Tenant::where('idnumber', $request->idnumber)->exists();
        $tenantemail = Tenant::where('email', $request->email)->exists();
        $tenantphonenumber = Tenant::where('phonenumber', $request->phonenumber)->exists();

            if ($tenantidnumber != null) {
               return redirect('/add-tenants')->with('statuserror','Id Number already registered, Tenant is already in the system')
                                              ->withInput($request->input());
            }
            if ($tenantemail != null) {
               return redirect('/add-tenants')->with('statuserror','Email already registered, Tenant is already in the system');
            }
            if ($tenantphonenumber != null) {
               return redirect('/add-tenants')->with('statuserror','Phone Number already registered,Tenant is already in the system');
            }
          
               
            
                $tenants = new Tenant;
                $tenants->idnumber = $request->input('idnumber');
                $tenants->firstname = $request->input('firstname');
                $tenants->lastname = $request->input('lastname');
                $tenants->email = $request->input('email');
                $tenants->phonenumber = $request->input('phonenumber');
                $tenants->occupation = $request->input('occupation');
                $tenants->company = $request->input('company');
                $tenants->emergencyname = $request->input('emergencyname');
                $tenants->emergencynumber = $request->input('emergencynumber');
                $tenants->status = $request->input('status');
                $tenants->apartment_id = $request->input('apartment_id');
                $tenants->save();

                $permissions = Permission::where('name','Tenants.destroy')->pluck('name')->toArray();
                $user = User::get()
                ->filter(function ($user) use ($permissions) {
                    foreach ($permissions as $permission) {
                        if (!$user->can($permission)) {
                            return false;
                        }
                    }
        
                    return $user;
                });
                
                $tenants->users()->attach($user);
        
                if(Tenant::join('tenant_user','tenant_user.tenant_id','=','tenants.id')
                ->where('tenant_user.tenant_id',$tenants->id)
                ->where('tenant_user.user_id',Auth::user()->id)->exists())
                    {
                        return redirect('tenants')->with('status','Tenant Added Successfully'); 
                    }
        
                else{
                $user2 = User::where('id',Auth::user()->id)->pluck('id')->toArray();
                $tenants->users()->attach($user2);
                }
  
            
            
            

                return redirect('tenants/')->with('status','Tenant Added Successfully. Attach and remove managers of the tenant');
            

            
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tenants = Tenant::find($id);
        $house = house::select('housenumber','status','id')->where('status', 'empty')->get();
        return view('tenants.edit', compact('tenants','house'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                 $validatedData = $request->validate([
                        'idnumber' => 'required|numeric',
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'email' => 'required',
                        'phonenumber' => 'required|numeric',
                        'occupation' => 'required',
                        'company' => '',
                        'emergencyname' => '',
                        'emergencynumber' => ''
                    ], [
                        'idnumber.required' => 'This field is required',
                        'idnumber.numeric' => 'Input Numbers Only',
                        'firstname.required'=> 'This field is required',
                        'lastname.required' => 'This field is required',
                        'email.required' => 'This field is required',
                        'phonenumber.required'=> 'This field is required',
                        'phonenumber.numeric' => 'Input Numbers only',
                        'occupation.required'=> 'This field is required',

                    ]);
        
                    
                    $temail = Tenant::where('id',$id)->select('email','idnumber','phonenumber')->first();
        
                    $tenants = Tenant::find($id);
                    $tenants->idnumber = $request->input('idnumber');
                    $tenants->firstname = $request->input('firstname');
                    $tenants->lastname = $request->input('lastname');
                    $tenants->email = $request->input('email');
                    $tenants->phonenumber = $request->input('phonenumber');
                    $tenants->occupation = $request->input('occupation');
                    $tenants->company = $request->input('company');
                    $tenants->emergencyname = $request->input('emergencyname');
                    $tenants->emergencynumber = $request->input('emergencynumber');
                    

        ///// if tenant being edited is equal to the tenant email entered then proceed
        if($temail->email == $request->get('email') ){
            $tenants->update();
            return redirect('/tenants')->with('status','Tenant Updated Successfully');
        }
        //// if house number,id and phonenumber entered exists in the system, create an error
        elseif(Tenant::where('email', $request->email)->exists()) {
            return redirect('/tenants')->with('statuserror','Tenant is already in the system');
        }
        elseif(Tenant::where('idnumber', $request->idnumber)->exists()) {
            return redirect('/tenants')->with('statuserror','Tenant is already in the system');
        }
        elseif(Tenant::where('phonenumber', $request->phonenumber)->exists()) {
            return redirect('/tenants')->with('statuserror','Tenant is already in the system');
        }
        else{
            $tenants->update();
            return redirect('/tenants')->with('status','Tenant Updated Successfully');
        }   

                    
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $tenants = Tenant::find($id);

        if(Lease::where('tenant_id',$id)->exists()){
            return redirect('/tenants')->with('statuserror','Cannot delete tenant. Lease is still active');
        }
        $tenants->delete();
        return redirect('/tenants')->with('status','Tenant Deleted Successfully');
    }

     public function profile($ID)
    {
        $tenants = Tenant::find($ID);
        $house = house::select('housenumber','status','id')->where('status', 'empty')->get();
        return view('tenants.profile', compact('tenants','house'));
    }

    public function attachmanagers($id){

        $tenants = Tenant::find($id);
        $userrole = Auth::user()->apartment_id;
        $permissions = Permission::where('name','Tenants.create')->pluck('name')->toArray();
     
        $user = User::get()
            ->filter(function ($user) use ($permissions) {
                foreach ($permissions as $permission) {
                    if (!$user->can($permission)) {
                        return false;
                    }
                }

                return $user;
            });
        
        $managerview = Tenant::join('tenant_user','tenant_user.tenant_id','=','tenants.id')
                            ->join('users','tenant_user.user_id','=','users.id')
                            ->where('tenants.id',$id)
                            ->select('tenant_user.id','users.name','tenant_user.user_id')
                            ->get();

        


        return view('tenants.addmanager', compact('tenants','user','managerview'));
    }

    public function storemanagers(Request $request, $id){

        if(Tenant::join('tenant_user','tenant_user.tenant_id','=','tenants.id')
                           ->where('tenant_user.tenant_id',$id)
                           ->where('tenant_user.user_id',$request->get('user_id'))->exists())
        {
            return redirect('/tenants')->with('statuserror','Manager Already added to Tenant');
        }

        $tenants = Tenant::find($id);
     
        $tenants->users()->attach($request->get('user_id'));

    
    

        return redirect('/tenants')->with('status','Tenant Manager Added Successfully');
    }
    public function updatemanagers(Request $request, $id){
        $tenants = Tenant::find($id);

        $tenants->users()->detach($request->get('user_id'));

     
       

    
    

        return redirect('/tenants')->with('status','Tenant Manager Updated Successfully');
    }
}
