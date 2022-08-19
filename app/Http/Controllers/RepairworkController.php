<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\models\invoice;
use App\models\invoiceitems;
use App\Models\Lease;
use App\Models\Tenant;
use App\Models\house;
use App\Models\Utilitycategories;
use App\Models\Utilitypayments;
use App\Models\Housecategories;
use App\Models\Maintenance;
use App\Models\Payments;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Readings;
use App\Models\paymenttypes;
use App\Models\Repairwork;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RepairworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workorder = Repairwork::all();
        $workorderyeargroup =Repairwork::selectRaw('year(created_at) as year,
                                            count(DISTINCT id) as noofworkorders')      
                        ->groupBy('year')
                        ->orderBy('year','asc')
                        ->get();
        return view('repairwork.index',compact('workorder','workorderyeargroup'));
    }
    public function indexmonth($year)
    {
        $workorder = Repairwork::all();
        $workordermonthgroup = Repairwork::selectRaw('year(created_at) as year, monthname(created_at) as month,
                            count(DISTINCT id) as noofworkorders')
                        ->whereYear('created_at', '=', Carbon::parse($year)->year)
                        ->groupBy('year', 'month')
                        ->orderBy('month','asc')
                        ->get();
        return view('repairwork.index',compact('workorder','workordermonthgroup'));  

    }

    public function viewrepairwork($year, $month)
    {
        $maintenance = Maintenance::join('lease','lease.id','=','maintenance.lease_id')
                                  ->join('houses', 'houses.id', '=', 'lease.houseID')
                                  ->join('tenants','tenants.id','=','lease.tenantID')
                                  ->join('repairwork','repairwork.maintenance_id','=','maintenance.id')
                                  ->select('tenants.firstname','tenants.lastname','tenants.email','houses.housenumber',
                                            'maintenance.name','repairwork.assignedto','maintenance.created_at','maintenance.priority','maintenance.maintenanceno',
                                            'maintenance.id','repairwork.Workid','repairwork.status','repairwork.amountpaid','repairwork.amountpaid','repairwork.dateofrepair','repairwork.updated_at')
                                            ->whereYear('maintenance.created_at', '=', Carbon::parse($year)->year)
                                            ->whereMonth('maintenance.created_at', '=', Carbon::parse($month)->month)
                                            ->get();
        return view('repairwork.viewrepairwork',compact('maintenance'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $maintenance = Maintenance::find($id);
        $roles = Role::with('users')
        ->where('name','Employee')
          ->get();
        return view('repairwork.create',compact('maintenance','roles'));
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
            'status' => 'required',
            'assignedto' => 'required',

        ], [
            'status.required' => 'This field is required',
            'assignedto.required' => 'This field is required',
    
        ]);

        $repairwork = new Repairwork();
        $repairwork->maintenance_id = $request->input('maintenance_id');
        $repairwork->Workid =$request->input('Workid');
        $repairwork->dateofrepair = $request->input('dateofrepair');  
        $repairwork->suppliesused = $request->input('suppliesused');  
        $repairwork->descworkdone = $request->input('descworkdone');
        $repairwork->recommendations = $request->input('recommendations');
        $repairwork->amountspent = $request->input('amountspent');
        $repairwork->amountpaid = $request->input('amountspent');
        $repairwork->assignedto = $request->input('assignedto');
        $repairwork->assignedby = Auth::user()->name;
        $repairwork->status = $request->input('status');
        $repairwork->save();

        $date = \Carbon\Carbon::parse($request->created_at);
        $month = \Carbon\Carbon::parse($request->created_at)->format('M');
        $year = $date->year;

        return redirect('Viewrepairwork/'.$year. '/' . $month)->with('status','Job work order added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workorder = Maintenance::join('lease','lease.id','=','maintenance.lease_id')
        ->join('houses', 'houses.id', '=', 'lease.houseID')
        ->join('tenants','tenants.id','=','lease.tenantID')
        ->join('repairwork','repairwork.maintenance_id','=','maintenance.id')
        ->select('tenants.firstname','tenants.lastname','tenants.email','houses.housenumber','tenants.idnumber','tenants.phonenumber',
                  'maintenance.name','repairwork.assignedto','maintenance.created_at','maintenance.priority','maintenance.description',
                  'maintenance.id','maintenance.lease_id','repairwork.Workid','repairwork.maintenance_id','repairwork.status','repairwork.amountpaid','repairwork.amountpaid',
                  'repairwork.dateofrepair','repairwork.assignedto')
                  ->where('maintenance.id', '=',$id)
                  ->first();

        $user = User::where('name',$workorder->assignedto)->first();

        return view('repairwork.show',compact('workorder','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repairwork = Repairwork::find($id);
        $roles = Role::with('users')
        ->where('name','Employee')
          ->get();
        return view('repairwork.edit',compact('repairwork','roles'));
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
            'status' => 'required',
            'assignedto' => 'required',

        ], [
            'status.required' => 'This field is required',
            'assignedto.required' => 'This field is required',
    
        ]);

        $repairwork = Repairwork::find($id);
        $repairwork->dateofrepair = $request->input('dateofrepair');  
        $repairwork->suppliesused = $request->input('suppliesused');  
        $repairwork->descworkdone = $request->input('descworkdone');
        $repairwork->recommendations = $request->input('recommendations');
        $repairwork->amountspent = $request->input('amountspent');
        $repairwork->amountpaid = $request->input('amountpaid');
        $repairwork->assignedto = $request->input('assignedto');
        $repairwork->status = $request->input('status');
        $repairwork->update();

        $date = \Carbon\Carbon::parse($request->created_at);
        $month = \Carbon\Carbon::parse($request->created_at)->format('M');
        $year = $date->year;

        return redirect('Viewrepairwork/'.$year. '/' . $month)->with('status','Repair Record Edited Successfully');
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
}
