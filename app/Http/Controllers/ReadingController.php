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
use App\Models\utilitiesassigned;
use App\Models\readings;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;


class ReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $readingsgrouping = readings:: selectRaw('year(fromdate) as year, monthname(fromdate) as month,
                                            count(recordno) as noofreadings')
                           
                        ->groupBy('year', 'month')
                        ->orderBy('month','desc')
                        ->get();
        $readings = Readings::get();

        return view('readings.index', compact('readingsgrouping','readings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $utilitycategories = utilitycategories::where('billcycle','Units')
                                        ->get(['id','name']);

        $house = lease::join('houses', 'houses.id', '=', 'lease.house_id')
                     ->get(["houses.housenumber","lease.id"]);

        return view('readings.create', compact('utilitycategories','house'));
    }
    public function fetchleasedetails(Request $request)
                    {
                        $data = Lease::join('tenants','tenants.id','=','lease.tenantID')
                                    ->where("lease.houseID",$request->houseID)
                                    ->get(["lease.id","lease.leaseno","tenants.firstname","tenants.lastname","tenants.email"]);
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

         $readingmonth = readings::where('lease_id','=', $request->input('lease_id'))
                                  ->where('utilitycategory_id',$request->utilitycategory_id)
                                   ->whereMonth('fromdate', '=',Carbon::parse($request->fromdate)->month)
                                   ->whereYear('fromdate', '=',Carbon::parse($request->fromdate)->year)
                                            ->exists();
             if ($readingmonth != null) {
                   return redirect('/readings')->with('statuserror','Monthly Reading for the House already Recorded')
                                                  ->withInput($request->input());
                }  


        $prefix = "WRD";
        $recordnounique = IdGenerator::generate(['table' => 'readings','field' => 'recordno', 'length' => 9, 'prefix' =>$prefix]);

        $reading = new readings;
        $reading->utilitycategory_id =  $request->input('utilitycategory_id');
        $reading->lease_id = $request->input('lease_id');
        $reading->meternumber = $request->input('meternumber');
        $reading->recordno = $recordnounique;
        $reading->initialreading = $request->input('initialreading');
        $reading->lastreading = $request->input('lastreading');
        $reading->currentreading = $request->input('currentreading');
        $reading->fromdate = $request->input('fromdate');
        $reading->todate = $request->input('todate');
        $reading->recorded_by = Auth::user()->email;
        $reading->save();

       return redirect('/readings')->with('status','Reading Created Successfully');
    }


      public function indexreadings($year, $month){

      $readings = readings::join('utilitycategory','utilitycategory.id','=','readings.utilitycategory_id')
                            ->join('lease', 'lease.id', '=', 'readings.lease_id')
                            ->join('houses','houses.id','=','lease.house_id')
                            ->join('tenants','tenants.id','=','Lease.tenant_id')
                            ->select('houses.housenumber','tenants.firstname','tenants.lastname','readings.meternumber',
                                     'readings.lastreading','readings.currentreading','readings.fromdate',
                                     readings::raw('(readings.currentreading - readings.lastreading) * utilitycategory.rate as amountdue'))
                            ->whereYear('readings.fromdate', '=', Carbon::parse($year)->year)
                             ->whereMonth('readings.fromdate', '=', Carbon::parse($month)->month)
                            ->get();

         return view('readings.index',compact('readings'));
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
