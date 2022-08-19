<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\house;
use App\Models\Utilitycategories;
use App\Models\Utilitypayments;
use App\Models\utilitiesassigned;
use App\Models\tenants;
use App\Models\lease;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class UtilitypaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Utilitypayments = Utilitypayments::join('utilitycategory','utilitycategory.id','=','utilitypayments.utilitycategoryid')
                                          ->join('lease','lease.id','=','utilitypayments.leaseID')
                                          ->join('houses','houses.id','=','lease.houseID')
                                          ->join('tenants','tenants.id','=','lease.tenantID')
                                          ->select('utilitypayments.utilityamountdue','utilitycategory.name','utilitycategory.billtype','utilitypayments.created_at','houses.housenumber','tenants.firstname','tenants.lastname')
                                          ->get();

        
      
        return view('Utilitypayments.index', compact('Utilitypayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
           $rent = House::where('status','Occupied')->get(["housenumber", "id"]);

         return view('Utilitypayments.create',compact('rent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
         $paymentmonth = utilitypayments::where('leaseID',$request->leaseID)
                                        ->whereMonth('created_at', '=',Carbon::parse($request->created_atreadonly)->month)
                                        ->exists();
         if ($paymentmonth != null) {
               return redirect('/add-utilitypayments')->with('statuserror','Utility Payment already made for the month')
                                              ->withInput($request->input());
            }
                $prefix = "UTIN";
                $utilityinvoicenounique = IdGenerator::generate(['table' => 'utilitypayments','field' => 'utilityinvoiceno', 'length' => 9, 'prefix' =>$prefix]);

      
                
                foreach ($request->leaseID as $index => $leaseID) {
                    $leaseID = $request->leaseID[$index];
                    $utilitycategoryid = $request->utilitycategoryid[$index];
                    $utilityamountdue = $request->utilityamountdue[$index];
                    $created_at = $request->created_at[$index];
                    $duedate = $request->duedate[$index];
                    $utilityinvoiceno = $utilityinvoicenounique;

                    Utilitypayments::updateorCreate([
                            'leaseID' => $leaseID,
                            'utilitycategoryid' =>$utilitycategoryid,
                            'utilityamountdue' =>$utilityamountdue,
                            'utilityamountpaid' => '0',
                            'created_at' =>$created_at,
                            'duedate' =>$duedate,
                            'utilityinvoiceno' =>$utilityinvoiceno
                        ]);
                }
            return redirect('/utilitypayments')->with('status','Utility Payment Created Successfully');
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
        //
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
        //
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
