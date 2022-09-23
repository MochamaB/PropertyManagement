<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Lease;
use App\Models\Maintenance;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\House;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenance = Maintenance::all();
        $maintenanceyeargroup =Maintenance::selectRaw('year(created_at) as year,
                                            count(DISTINCT id) as noofrepairs')      
                        ->groupBy('year')
                        ->orderBy('year','asc')
                        ->get();

        

        return view('maintenance.index',compact('maintenance','maintenanceyeargroup'));  
    }
    public function indexmonth($year)
    {
        $maintenance = Maintenance::all();
        $maintenancemonthgroup = Maintenance::selectRaw('year(created_at) as year, monthname(created_at) as month,
                            count(DISTINCT id) as noofrepairs')
                        ->whereYear('maintenance.created_at', '=', Carbon::parse($year)->year)
                        ->groupBy('year', 'month')
                        ->orderBy('month','asc')
                        ->get();
        return view('maintenance.index',compact('maintenance','maintenancemonthgroup'));  

    }


    public function viewmaintenance($year,$month){

        $maintenance = Maintenance::join('lease','lease.id','=','maintenance.lease_id')
                                  ->join('houses', 'houses.id', '=', 'lease.house_id')
                                  ->join('tenants','tenants.id','=','lease.tenant_id')
                                  ->leftjoin('repairwork','repairwork.maintenance_id','=','maintenance.id')
                                  ->select('tenants.firstname','tenants.lastname','tenants.email','houses.housenumber',
                                            'maintenance.billtype','maintenance.raisedby','maintenance.created_at','maintenance.priority','maintenance.maintenanceno','maintenance.name',
                                            'maintenance.id','repairwork.Workid','repairwork.status','repairwork.amountpaid','repairwork.amountpaid')
                                            ->whereYear('maintenance.created_at', '=', Carbon::parse($year)->year)
                                            ->whereMonth('maintenance.created_at', '=', Carbon::parse($month)->month)
                                            ->get();

        return View('maintenance.viewmaintenance',compact('maintenance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $house = lease::join('houses', 'houses.id', '=', 'lease.house_id')
        ->get(["houses.housenumber", "lease.id"]);
         
         $roles = Role::with('users')
                      ->where('name','Employee')
                        ->get();

        
        return view('maintenance.create',compact('house','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $house = lease::join('houses', 'houses.id', '=', 'lease.house_id')
                        ->where('lease.id',$request->lease_id)
                        ->select('houses.housenumber')
                        ->first();

        $createddate = Carbon::parse($request->created_at)->format('ym');

        $validatedData = $request->validate([
            'lease_id' => 'required',
            'priority' => 'required',
            'billtype' => 'required',
            'name' => 'required',
            'description' => 'required',
            
            
        ], [
            'lease_id.required' => 'This field is required',
            'priority.required' => 'This field is required',
            'billtype.required' => 'This field is required',
            'name.required' => 'This field is required',
            'description.required' => 'This field is required',
    
        ]);
        $maintenance = new Maintenance();
        $maintenance->lease_id = $request->input('lease_id');
        $maintenance->maintenanceno ='REPAIR'.$createddate.$house->housenumber;
        $maintenance->priority = $request->input('priority');  
        $maintenance->billtype = $request->input('billtype');  
        $maintenance->name = $request->input('name');
        $maintenance->description = $request->input('description');;
        $maintenance->raisedby = Auth::user()->name;
        $maintenance->save();

        $date = \Carbon\Carbon::parse($request->created_at);
        $month = \Carbon\Carbon::parse($request->created_at)->format('M');
        $year = $date->year;
        return redirect('/YearViewmaintenance')->with('status','Repair Record Added Successfully');
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
        $maintenance = Maintenance::find($id);
        $roles = Role::with('users')
        ->where('name','Employee')
          ->get();
        return view('maintenance.edit', compact('maintenance','roles'));
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
            'priority' => 'required',
            'billtype' => 'required',
            'name' => 'required',
            'description' => 'required',
            
            
        ], [
            'priority.required' => 'This field is required',
            'billtype.required' => 'This field is required',
            'name.required' => 'This field is required',
            'description.required' => 'This field is required',
    
        ]);
        $maintenance = Maintenance::find($id);
        $maintenance->priority = $request->input('priority');  
        $maintenance->billtype = $request->input('billtype');  
        $maintenance->name = $request->input('name');
        $maintenance->description = $request->input('description');
        $maintenance->Update();

        $date = \Carbon\Carbon::parse($request->created_at);
        $month = \Carbon\Carbon::parse($request->created_at)->format('M');
        $year = $date->year;

        return redirect('Viewmaintenance/'.$year. '/' . $month)->with('status','Repair Record Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maintenance = Maintenance::find($id);
        $maintenance->delete();
        return redirect('/YearViewmaintenance')->with('status','Repair Record Deleted Successfully');
    }
}
