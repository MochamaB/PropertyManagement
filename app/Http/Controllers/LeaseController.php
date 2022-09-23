<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lease;
use App\Models\Tenant;
use App\Models\house;
use App\Models\Utilitycategories;
use App\Models\Housecategories;
use App\Models\utilitiesassigned;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lease = lease::FilterByHouseAccess()
        ->get();
                      

        return view('lease.index', compact('lease'));
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userrole = Auth::user()->apartment_id;
        $useraccess = Auth::user()->id;
        $house= House::FilterByUSerRole()->FilterByUSerAccess()->with('apartment')->where('status','Empty')
            ->select('houses.id','houses.housenumber','houses.*')->get();
        $apartment = Apartment::get();

        $tenant = Tenant::FilterByAdmin()->with('apartment')->where('status','No Lease')->select('tenants.*')->get();
        return view('lease.create', compact('house','tenant','apartment'));
    }

    public function fetchleaserent(Request $request)
    {
        $data = Housecategories::join('houses','houses.housecategoryid','=','housecategories.id')
                    ->where("houses.id",$request->house_id)
                    ->get(["houses.title","housecategories.rent","housecategories.setdeposit"]);
        return response()->json($data);
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
            'rent' => 'required|numeric',
            'deposit' => 'required|numeric'
           
        ], [
            'rent.required' => 'This field is required',
            'rent.numeric' => 'Input Numbers Only',
            'deposit.required' => 'This field is required',
            'deposit.numeric' => 'Input Numbers Only',
        ]);

         
        if(Lease::where('house_id',$request->house_id)->where('status','active')->exists()){
            return redirect('/add-house')->with('statuserror','House  already Has a lease, Deactivate Lease and try again')
                                       ->withInput($request->input());
        }

        ///// Make sure that user that is registered from the registration page is assigned the right apartment ID
        if($request->apartment_id == null){
            $apartmentid = Auth::user()->apartment_id; ///Assigns the current users logged in apartment ID
        }else{
            $apartmentid = $request->input('apartment_id'); //// Assigns apartment from edit form
        }

        $prefix = "LSE-";
        $leasenounique = IdGenerator::generate(['table' => 'lease','field' => 'leaseno', 'length' => 7, 'prefix' =>$prefix]);

        $lease = new lease;
        $lease->leaseno = $leasenounique;
        $lease->apartment_id = $apartmentid;
        $lease->house_id = $request->input('house_id');
        $lease->tenant_id = $request->input('tenant_id');  
        $lease->deposit = $request->input('deposit');
        $lease->rent = $request->input('rent');
        $lease->startdate = $request->input('startdate');
        $lease->enddate = $request->input('enddate');
        $lease->status = $request->input('status');
        $lease->terms = $request->input('terms');
        $lease->save();

    
        $housestatus = house::updateOrCreate(
                       [
                            'id'    => $request->input('house_id')
                        ], 
                        [
                            'status'  => 'Occupied',    
                        ]
                  
                        );
        $tenantstatus = Tenant::updateOrCreate(
            [
                'id'    => $request->input('tenant_id')
            ], 
            [
                'status'  => 'Active_lease',    
            ]
    
            );


         return redirect('/leases')->with('status','Lease Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $lease = Lease::find($id);
        $leasedetails = lease::join('tenants', 'tenants.id', '=', 'lease.tenant_id')
                      ->join('houses', 'houses.id', '=', 'lease.house_id')
                      ->join('housecategories','housecategories.id','=','houses.housecategoryid')
                      ->select('lease.id','lease.leaseno','houses.housenumber','tenants.firstname','tenants.lastname','lease.rent',
                                'lease.deposit','lease.terms','housecategories.type','lease.created_at')
                      ->where('lease.id',$id)
                      ->first();

        return view('lease.edit', compact('leasedetails','lease'));
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
            'rent' => 'required|numeric',
            'deposit' => 'required|numeric',
            'status' => 'required|'
           
        ], [
            'rent.required' => 'This field is required',
            'rent.numeric' => 'Input Numbers Only',
            'deposit.required' => 'This field is required',
            'deposit.numeric' => 'Input Numbers Only',
            'status.required' => 'This field is required',
        ]);
        
        
        $lease = Lease::find($id);
        $lease->deposit = $request->input('deposit');
        $lease->rent = $request->input('rent');
        $lease->startdate = $request->input('startdate');
        $lease->enddate = $request->input('enddate');
        $lease->status = $request->input('status');
        $lease->terms = $request->input('terms');
        $lease->update();

        /////Make sure that the houses table is filled with either Empty or Occupied
        if($request->input('status') == 'Active'){ $hstatus = 'Occupied';}
        else{ $hstatus ='Empty'; }

            $housestatus = house::updateOrCreate(
                [
                    'id'    => $lease->house_id
                ], 
                [
                    'status'  => $hstatus,    
                ]
        
                );
            $tenantstatus = Tenant::updateOrCreate(
            [
                'id'    => $lease->tenant_id
            ], 
            [
                'status'  => $request->input('status').'_lease',    
            ]

            );

        return redirect('/leases')->with('status','Lease Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function details($id)
    {
        $lease = Lease::find($id);
        $leasedetails = lease::join('tenants', 'tenants.id', '=', 'lease.tenant_id')
                      ->join('houses', 'houses.id', '=', 'lease.house_id')
                      ->join('housecategories','housecategories.id','=','houses.housecategoryid')
                      ->select('lease.id','lease.leaseno','houses.housenumber','tenants.firstname','tenants.lastname','lease.rent',
                                'lease.deposit','housecategories.type','lease.created_at')
                      ->where('lease.id',$id)
                      ->first();
        
        
        return view('lease.details', compact('lease','leasedetails'));
    }
}
