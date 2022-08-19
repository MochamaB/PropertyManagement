<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\models\invoice;
use App\Models\Lease;
use App\Models\Tenant;
use App\Models\house;
use App\Models\Utilitycategories;
use App\Models\Housecategories;
use App\Models\Maintenance;
use App\Models\Payments;
use App\Models\utilitiesassigned;
use App\Models\Readings;
use App\Models\paymenttypes;
use App\Models\SentEmail;
use Illuminate\Support\Str;
use PDF;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoiceitems = Utilitycategories::where('create_invoice','1')->get();
        ////////////// get All view in invoice index
        $yearinvoicegrouping =invoice:: leftjoin('payments','payments.invoice_id','=','invoices.id')
                                    ->selectRaw('year(invoices.invoicedate) as year,invoices.invoicetype,
                                            count(DISTINCT invoices.invoiceno) as noofinvoices')
                                  ->selectRaw('SUM(invoices.amountdue) as totalamountdue')
                                  ->selectRaw('SUM(payments.amountpaid) as totalamountpaid')
                        ->with('payments') 
                        ->groupBy('year','invoices.invoicetype')
                        ->orderBy('year','desc')
                        ->get(); 

         
         return view('invoice.index', compact('yearinvoicegrouping','invoiceitems')); 
    }
     
    public function indexmonth($year,$invoicetype)
    {
        $invoiceitems = Utilitycategories::where('create_invoice','1')->get();
        ///////////// get the month view for all invoices
        $invoicegrouping = invoice:: leftjoin('payments','payments.invoice_id','=','invoices.id')
                                ->selectRaw('year(invoices.invoicedate) as year, monthname(invoices.invoicedate) as month, invoices.invoicetype,
                                        count(DISTINCT invoices.invoiceno) as noofinvoices')
                            ->selectRaw('SUM(invoices.amountdue) as totalamountdue')
                                ->selectRaw('SUM(payments.amountpaid) as totalamountpaid')
                            ->with('payments')        
                            ->where('invoices.invoicetype',$invoicetype)
                            ->whereYear('invoices.invoicedate', '=', Carbon::parse($year)->year)
                            ->groupBy('year', 'month','invoices.invoicetype')
                            ->orderBy('month','asc')
                            ->get();
        $invtype = Invoice::where('invoicetype',$invoicetype)->pluck('invoicetype');

        return view('invoice.index', compact('invoicegrouping','invtype','invoicetype','invoiceitems')); 

    }
    //////////// get the List detail view for all invoices
    public function ListInvoices($year,$month,$invoicetype)
    {
        $invoiceitems = Utilitycategories::where('create_invoice','1')->get();
     $details = invoice::join('lease','lease.id','=','Invoices.lease_id')
                                 ->join('houses', 'houses.id', '=', 'lease.house_id')
                                 ->join('tenants','tenants.id','=','lease.tenant_id')
                                 ->select('invoices.id','tenants.firstname','tenants.lastname','tenants.email','houses.housenumber','invoices.lease_id',
                                          'invoices.created_at','invoices.status','invoices.duedate','invoices.invoicedate','invoices.amountdue',
                                          'invoices.invoiceno','invoices.invoicetype'
                                    )
                                    ->with('payments')
                                    ->where('invoices.invoicetype',$invoicetype)
                                    ->whereYear('invoices.invoicedate', '=', Carbon::parse($year)->year)
                                    ->whereMonth('invoices.invoicedate', '=', Carbon::parse($month)->month)
                                    
                                    
                                          ->get();
        $invoice = Invoice::where('invoices.invoicetype',$invoicetype)->first();
      
         return view('invoice.ListInvoice',compact('details','invoice','invoiceitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
   
    }
     
                    public function fetchRent(Request $request)
                    {
                        $data = Lease::join('tenants','tenants.id','=','lease.tenant_id')
                                    ->join('utilitiesassigned','utilitiesassigned.leaseid','=','Lease.id')
                                    ->join('utilitycategory','utilitycategory.id','=','utilitiesassigned.utilitycategoryid')
                                    ->where("lease.house_id",$request->house_id)
                                    ->get(["lease.actualdeposit","lease.id","lease.actualrent","utilitycategory.name","tenants.firstname","tenants.lastname","tenants.email"]);
                        return response()->json($data);
                    }
                 


                     public function fetchUtilities(Request $request)
                    {
                        $data = utilitiesassigned::join('utilitycategory','utilitycategory.id','=','utilitiesassigned.utilitycategoryid')
                                 
                                        ->where("utilitiesassigned.leaseid",$request->leaseid)
                                        ->select('utilitycategory.name','utilitycategory.billtype','utilitycategory.rate','utilitiesassigned.leaseid','utilitiesassigned.utilitycategoryid')
                                        ->get();
                        return response()->json($data);
                    }

                    public function fetchUtilityPayments(Request $request)
                    {
                        $data = house::join('lease','houses.id','=','lease.houseID')
                                      ->join('utilitypayments','utilitypayments.lease_id','=','lease.id')
                                      ->join('utilitycategory','utilitycategory.id','=','utilitypayments.utilitycategoryid')
                                      ->where("houses.id",$request->houseid)
                                        ->select('houses.housenumber')
                                        ->get();
                        return response()->json($data);
                    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
             //////////////////////////////////////////////////  GENERATE from Lease INVOICE     ////////////////////////////////////////////////////
    public function fromleaseInvoice(Request $request)
    {
         
        $paymentmonth = invoice::where('invoicetype','=',$request->invoicetype)
                               ->whereMonth('invoicedate', '=',Carbon::parse($request->invoicedate)->month)
                               ->whereYear('invoicedate', '=',Carbon::parse($request->invoicedate)->year)
                               ->select('lease_id')
                                        ->exists();
         if ($paymentmonth != null) {
               return redirect('/invoices')->with('statuserror','Monthly '. $request->invoicetype. ' invoices for all houses already generated for the month')
                                              ->withInput($request->input());
            }  

            $leasedetails = lease::join('houses','houses.id','=','lease.house_id')
                                 ->select('lease.id','lease.actualrent','houses.housenumber')   
                                   ->get();
            $truncate = Str::limit($request->invoicetype, 3,$end='');                       
            $prefix = Str::Upper($truncate);

                foreach ($leasedetails as $key => $row) {
                    $lease_id = $row->id;
                    
                    $invoicetype = $request->invoicetype;
                    $amountdue = $row->actualrent;
                    $invoicedate = $request->invoicedate;
                    $duedate = $request->duedate;

                    $invoicenodate = Carbon::parse($request->invoicedate)->format('ym');
                   
                    invoice::updateorCreate([
                            'invoiceno' => $prefix.$invoicenodate.$row->housenumber,
                            'lease_id' =>$lease_id,
                            'invoicetype' =>$invoicetype,
                            'amountdue' => $amountdue,
                            'status' =>'Unpaid',
                            'expensetype' => 'Income',
                            'duedate' =>$duedate,
                            'invoicedate' => $invoicedate,
                            'raised_by' => Auth::user()->email,
                            'reviewed_by'=>''
                        ]);
                        }


      

         return redirect('/invoices')->with('status','Invoices for '. $invoicetype. ' created Successfully');
    }

   

        /////////////////////////////////////////////    Per month    ////////////////////////////////////////////////////////////

    public function permonthInvoice(Request $request)
    {  
            $paymentmonth = invoice::where('invoicetype','=',$request->invoicetype)
                                   ->whereMonth('invoicedate', '=',Carbon::parse($request->invoicedate)->month)
                                   ->whereYear('invoicedate', '=',Carbon::parse($request->invoicedate)->year)
                                   ->select('lease_id')
                                            ->exists();
             if ($paymentmonth != null) {
                   return redirect('/invoices')->with('statuserror','Monthly Trash invoices for all houses already generated for the month')
                                                  ->withInput($request->input());
                }  
    
           $permonthrate = Utilitycategories::where('name', $request->invoicetype)->pluck('rate')->first();
           $leasedetails = lease::join('houses','houses.id','=','lease.house_id')
                                 ->select('lease.id','lease.actualrent','houses.housenumber')   
                                   ->get();
            $truncate = Str::limit($request->invoicetype, 3,$end='');                       
            $prefix = Str::Upper($truncate);

                foreach ($leasedetails as $key => $row) {
                    $lease_id = $row->id;
                    
                    $invoicetype = $request->invoicetype;
                    $amountdue = $permonthrate;
                    $invoicedate = $request->invoicedate;
                    $duedate = $request->duedate;
                    $invoicenodate = Carbon::parse($request->invoicedate)->format('ym');
                    invoice::updateorCreate([
                            'invoiceno' => $prefix.$invoicenodate.$row->housenumber,
                            'lease_id' =>$lease_id,
                            'invoicetype' =>$invoicetype,
                            'amountdue' => $amountdue,
                            'status' =>'Unpaid',
                            'expensetype' => 'Income',
                            'duedate' =>$duedate,
                            'invoicedate' => $invoicedate,
                            'raised_by' => Auth::user()->email,
                            'reviewed_by'=>''
                        ]);
                        }

         return redirect('/invoices')->with('status','Invoices for '. $invoicetype. ' created Successfully');
    }



    ///////////////////////////////////////////////////////   Per Units     ////////////////////////////////////////////////////////
     public function unitsInvoice(Request $request)
    {
            $readingsleaseids = readings::where('fromdate','=',$request->invoicedate)->pluck('lease_id')->all();
            $invoiceleaseids = invoice::where('invoicedate','=',$request->invoicedate)->whereNotIn('lease_id', $readingsleaseids)->select('lease_id')->get();
           
            $leasedetails = lease::join('readings','readings.lease_id','=','lease.id')
                                 ->join('utilitycategory','utilitycategory.id','=','readings.utilitycategory_id')
                                 ->join('houses', 'houses.id', '=', 'lease.house_id')
                                 ->select('readings.lease_id','houses.housenumber',
                                    lease::raw('(readings.currentreading - readings.lastreading) * utilitycategory.rate as amountdue'))
                                  ->whereMonth('readings.fromdate', '=',Carbon::parse($request->invoicedate)->month)
                                 ->get();
            $readings = readings::whereMonth('fromdate', '=',Carbon::parse($request->invoicedate)->month)
                                ->whereYear('fromdate', '=',Carbon::parse($request->invoicedate)->year)
                                ->exists();
            if ($readings == null) {
                return redirect('/invoices')->with('statuserror','Cannot generate Invoices. Readings for the selected month have not been recorded')
                                            ->withInput($request->input());
            }  
            $truncate = Str::limit($request->invoicetype, 3,$end='');                       
            $prefix = Str::Upper($truncate);
                foreach ($leasedetails as $key => $row) {
                    $lease_id = $row->lease_id;
                    
                    $invoicetype = $request->invoicetype;
                    $amountdue = $row->amountdue;
                    $invoicedate = $request->invoicedate;
                    $duedate = $request->duedate;
                    $invoicenodate = Carbon::parse($request->invoicedate)->format('ym');
                    $invoiceno = $prefix.$invoicenodate.$row->housenumber;
                    if ($invoiceleaseids == null)
                    {
                         return redirect('/invoices')->with('statuserror','Monthly '. $invoicetype. ' Invoices already Generated for the month');
                    }
                                      
                else {
                    invoice::updateorCreate([
                            'invoiceno' => $invoiceno,
                            'lease_id' =>$lease_id,
                            'invoicetype' =>$invoicetype,
                            'amountdue' => $amountdue,
                            'status' =>'Unpaid',
                            'expensetype' => 'Income',
                            'duedate' =>$duedate,
                            'invoicedate' => $invoicedate,
                            'raised_by' => Auth::user()->email,
                            'reviewed_by'=>''
                        ]);
                        }
                        }

         return redirect('/invoices')->with('status','Invoice for '. $invoicetype. ' Utility created Successfully');
    }
///////////////////////////////////////////////////////   Maintenance     ////////////////////////////////////////////////////////
    public function maintenenaceinvoice(Request $request)
    {
     
                    $maintenance = Maintenance::whereMonth('created_at', '=',Carbon::parse($request->invoicedate)->month)
                                        ->whereYear('created_at', '=',Carbon::parse($request->invoicedate)->year)
                                        ->exists();
                    if ($maintenance == null) {
                    return redirect('/invoices')->with('statuserror','No Maintenance Repairs were done during selected period')
                                        ->withInput($request->input());
                    }  
                    
                    $leasedetails = Lease::join('maintenance','maintenance.lease_id','=','lease.id')
                                        ->join('repairwork','repairwork.maintenance_id','=','maintenance.id')
                                        ->join('houses', 'houses.id', '=', 'lease.house_id')
                                        ->select('maintenance.lease_id','repairwork.amountspent','repairwork.amountpaid','houses.housenumber')
                                        ->whereMonth('maintenance.created_at', '=',Carbon::parse($request->invoicedate)->month)
                                        ->get();

                         foreach ($leasedetails as $key => $row) {
                            $lease_id = $row->lease_id;
                            
                            $invoicetype = $request->invoicetype;
                            $amountdue = $row->amountspent + $row->amountpaid;
                            if($amountdue == null){
                                $amountdue = 100;
                            }
                            $invoicedate = $request->invoicedate;
                            $duedate = $request->duedate;
                            $invoicenodate = Carbon::parse($request->invoicedate)->format('ym');
                            invoice::updateorCreate([
                                    'invoiceno' => 'MAIN'.$invoicenodate.$row->housenumber,
                                    'lease_id' =>$lease_id,
                                    'invoicetype' =>$invoicetype,
                                    'amountdue' => $amountdue,
                                    'status' =>'Unpaid',
                                    'expensetype' => 'Income',
                                    'duedate' =>$duedate,
                                    'invoicedate' => $invoicedate,
                                    'raised_by' => Auth::user()->email,
                                    'reviewed_by'=>''
                                ]);
                                }


        return redirect('/invoices')->with('status','Invoice for '. $invoicetype. ' Costs created Successfully');  
    }
  

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
        $invoice = Invoice::find($id);
        $invoicedetails= invoice::join('lease','lease.id','=','invoices.lease_id')
                                ->join('houses','houses.id','=','lease.house_id')
                                ->join('tenants','tenants.id','=','lease.tenant_id')
                                ->select('invoices.invoiceno','houses.housenumber','tenants.firstname','tenants.lastname','tenants.idnumber',
                                        'tenants.email','tenants.phonenumber','invoices.invoicedate','Invoices.duedate','Invoices.status',
                                        'invoices.amountdue','invoices.invoicetype','invoices.lease_id','invoices.id')
                                        ->with('payments')
                                        ->where('invoices.id',$id)
                                        
                                
                                ->first();
        return view('invoice.edit', compact('invoice','invoicedetails'));
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
            'amountdue' => 'required|numeric',
            'duedate' => 'required',
     
        ], [
            'amountdue.required' => 'This field is required',
            'amountdue.numeric' => 'Enter numbers only',
            'duedate.required' => 'This field is required',
    
        ]);
        $invoice = Invoice::find($id);
        $invoice->amountdue = $request->input('amountdue'); 
        $invoice->duedate = $request->input('duedate'); 
        $invoice->update();

        $date = \Carbon\Carbon::parse($invoice->invoicedate);
        $month = \Carbon\Carbon::parse($invoice->invoicedate)->format('M');
        $year = $date->year;

        return redirect('invoices/ListInvoices/'.$year. '/' . $month. '/' . $invoice->invoicetype)->with('status','Invoice Edited Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $date = \Carbon\Carbon::parse($invoice->invoicedate);
        $month = \Carbon\Carbon::parse($invoice->invoicedate)->format('M');
        $year = $date->year;

        $payment = Payments::join('invoices','payments.invoice_id','=','invoices.id')
                          ->where('invoices.id',$id)
                          ->exists();
        if ($payment != null) {
        return redirect('invoices/ListInvoices/'.$year. '/' . $month. '/' . $invoice->invoicetype)->with('statuserror','First delete all payments attached to the Invoice');
                                    
    }  
        
        $invoice->delete();

       
        return redirect('invoices/ListInvoices/'.$year. '/' . $month. '/' . $invoice->invoicetype)->with('status','Invoice Deleted Successfully'); 
    }

     public function details($id,$lease_id,$invoicedate,$invoicetype)
    {
        $invoice = invoice::find($id);

        $invoicedetails= invoice::join('lease','lease.id','=','invoices.lease_id')
                                ->join('houses','houses.id','=','lease.house_id')
                                ->join('tenants','tenants.id','=','lease.tenant_id')
                                ->select('invoices.invoiceno','houses.housenumber','tenants.firstname','tenants.lastname','tenants.idnumber',
                                        'tenants.email','tenants.phonenumber','invoices.invoicedate','Invoices.duedate','Invoices.status',
                                        'invoices.amountdue','invoices.invoicetype','invoices.lease_id','invoices.id')
                                        ->with('payments')
                                        ->where('invoices.id',$id)
                                        
                                
                                ->first();

      
        
        $previousbalancedue = invoice::selectRaw('SUM(amountdue) as totaldue')
                                    ->where('lease_id',$lease_id)
                                    ->where('invoicetype',$invoicetype)
                                    ->where('invoicedate', '<',$invoicedate)
                                    ->first();
        $previousbalancepaid = payments::selectRaw('SUM(amountpaid) as totalpaid')
        ->where('lease_id',$lease_id)
        ->where('paymentitem',$invoicetype)
        ->where('invoicedate', '<',$invoicedate)
        ->first();
        
        $paymenttypes = paymenttypes::all();
        
        $paymentsinfo = invoice::with('payments')->find($id);
        
        $previousmonthsbalance = $previousbalancedue->totaldue - $previousbalancepaid->totalpaid;
        $utilitycat = Utilitycategories:: where('name',$invoicetype)->first();
        $readings = readings::where('fromdate','=',$invoicedate)
        ->where('lease_id',$lease_id)
        ->first();
        $watercharge = Utilitycategories:: where('name','Water Standing Charge')->first();
        $sentemail = SentEmail::where('item_id',$id)->first();
        

               
        return view('invoice.invoicedetails',compact('invoicedetails','paymenttypes','paymentsinfo','previousmonthsbalance','readings','utilitycat','watercharge','sentemail'));
    }

 
}
