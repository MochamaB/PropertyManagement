<?php

namespace App\Http\Controllers;

use App\Models\ChildUtilities;
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
use App\Models\Task;
use Illuminate\Support\Str;
use PDF;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

use function PHPUnit\Framework\isNull;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryitems = Utilitycategories::where('create_invoice','1')->get();
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
        $task = Task::where('type','invoice')->first();

         
         return view('invoice.index', compact('yearinvoicegrouping','categoryitems','task')); 
    }
     
    public function indexmonth($year,$invoicetype)
    {
        $categoryitems = Utilitycategories::where('create_invoice','1')->get();
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
                            ->orderBy('month','desc')
                            ->get();
        $invtype = Invoice::where('invoicetype',$invoicetype)->pluck('invoicetype');
        $task = Task::where('type','invoice')->first();

        return view('invoice.index', compact('invoicegrouping','invtype','invoicetype','categoryitems','task')); 

    }
    //////////// get the List detail view for all invoices
    public function ListInvoices($year,$month,$invoicetype)
    {
        $categoryitems = Utilitycategories::where('create_invoice','1')->get();
     $details = invoice::join('lease','lease.id','=','Invoices.lease_id')
                                 ->join('houses', 'houses.id', '=', 'lease.house_id')
                                 ->join('tenants','tenants.id','=','lease.tenant_id')
                                 ->select('invoices.id','tenants.firstname','tenants.lastname','tenants.email','houses.housenumber','invoices.lease_id',
                                          'invoices.created_at','invoices.duedate','invoices.invoicedate','invoices.amountdue',
                                          'invoices.invoiceno','invoices.invoicetype','invoices.parent_utility'
                                    )
                                    ->with('payments')
                                    ->where('invoices.invoicetype',$invoicetype)
                                    ->whereYear('invoices.invoicedate', '=', Carbon::parse($year)->year)
                                    ->whereMonth('invoices.invoicedate', '=', Carbon::parse($month)->month)
                                    
                                    
                                          ->get();
        $invoice = Invoice::where('invoices.invoicetype',$invoicetype)->first();

        foreach($details as $item){
            $parentutilsum = collect($item->parent_utility);
            
        }
      
         return view('invoice.ListInvoice',compact('details','invoice','categoryitems','parentutilsum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
             //////////////////////////////////////////////////  GENERATE from Lease INVOICE     ////////////////////////////////////////////////////
    public function GenerateInvoice(Request $request)
    {
        /// Used to check if an invoice for the month has already been generated
        $paymentmonth = invoice::where('invoicetype','=',$request->utilcateg)
                               ->whereMonth('invoicedate', '=',Carbon::parse($request->invoicedate)->month)
                               ->whereYear('invoicedate', '=',Carbon::parse($request->invoicedate)->year)
                               ->select('lease_id')
                                        ->exists();
        $readings = readings::whereMonth('fromdate', '=',Carbon::parse($request->invoicedate)->month)
                    ->whereYear('fromdate', '=',Carbon::parse($request->invoicedate)->year)
                    ->get();
                    
        $invoicedate = $request->invoicedate;
      
         $utildetails = Utilitycategories::where('name',$request->utilcateg)->first();
         ////Get Utility category_id, invoicetype, prefix,
         $childutildetails = Utilitycategories::join('utilitycategory as UT2','utilitycategory.id','=','UT2.parent_utility')
                                            ->where('utilitycategory.name',$request->utilcateg)
                                            ->get();
        $parentutilities = Utilitycategories::join('utilitycategory as UT2','utilitycategory.id','=','UT2.parent_utility')
                                ->where('utilitycategory.name',$request->utilcateg)
                                ->select('UT2.name','UT2.rate','UT2.billcycle')
                                ->get();
        $maintenance = Maintenance::whereMonth('created_at', '=',Carbon::parse($request->invoicedate)->month)
                                ->whereYear('created_at', '=',Carbon::parse($request->invoicedate)->year)
                                ->exists();
                
           
        
        

         if($utildetails->billcycle =='Units'){
                $leasedetails = lease::join('houses','houses.id','=','lease.house_id') 
                                 ->join('readings','readings.lease_id','=','lease.id')
                                 ->where('readings.utilitycategory_id',$utildetails->id)
                                 ->whereMonth('fromdate', '=',Carbon::parse($invoicedate)->month)
                                 ->whereYear('fromdate', '=',Carbon::parse($invoicedate)->year)
                                 ->select('lease.id','houses.housenumber','readings.amountdue')
                                 ->get();
         }
         elseif($utildetails->billcycle =='Maintenance'){
            $leasedetails = Lease::join('maintenance','maintenance.lease_id','=','lease.id')
                                        ->join('repairwork','repairwork.maintenance_id','=','maintenance.id')
                                        ->join('houses', 'houses.id', '=', 'lease.house_id')
                                        ->whereMonth('maintenance.created_at', '=',Carbon::parse($invoicedate)->month)
                                        ->whereYear('maintenance.created_at', '=',Carbon::parse($invoicedate)->year)
                                        ->where('billtype','Income')
                                        ->select('lease.id','repairwork.amountspent','repairwork.amountpaid','houses.housenumber')
                                        ->selectRaw('(repairwork.amountspent + repairwork.amountpaid) as totalamount')
                                        ->get();

         }
          else{              
                $leasedetails = lease::join('houses','houses.id','=','lease.house_id')               
                            ->select('lease.id','lease.rent','houses.housenumber')
                            ->get();
              }
   
          foreach ($leasedetails as $key => $row) {
                    $lease_id = $row->id;
                    $invoicetype = $request->utilcateg;

                    if($utildetails->billcycle =='Fromlease'){
                        if ($paymentmonth != null) {
                            return redirect('/invoices')->with('statuserror','Monthly '. $request->utilcateg. ' invoices for all houses already generated for the month');                                 
                         } else{ 
                                    
                                $amountdue = $row->rent;
                                }
                    }
                    elseif($utildetails->billcycle =='Permonth'){
                        if ($paymentmonth != null) {
                            return redirect('/invoices')->with('statuserror','Monthly '. $request->utilcateg. ' invoices for all houses already generated for the month');
                         } 
                         else{ 
                                $amountdue = $utildetails->rate;
                         }
                    }
                    elseif($utildetails->billcycle =='Maintenance'){
                        if ($maintenance == null) {
                            return redirect('/invoices')->with('statuserror','Monthly '. $request->utilcateg. ' invoices for all houses already generated for the month');
                         } 
                         else{ 
                                $amountdue = $row->totalamount;
                         }
                    }
                    elseif($utildetails->billcycle =='Units'){
                                $amountdue = $row->amountdue;     
                         
                    }

                    if($childutildetails !=null){
                        $parentutility = array();
                        foreach($parentutilities as $putil){
                            $parentutility[] = array(
                                'utilname' =>$putil->name,
                                'amount' => $putil->rate,
                            );
                        }}else{$parentutility = 0;}

                    
        
                    $invoicedate = $request->invoicedate;
                    $duedate = $request->duedate;

                    $invoicenodate = Carbon::parse($request->invoicedate)->format('ym');
                   
                    $invoice = invoice::updateorCreate([
                            'invoiceno' => $utildetails->prefix.$invoicenodate.$row->housenumber,
                            'lease_id' =>$lease_id,
                            'utilitycategory_id' =>$utildetails->id,
                            'parent_utility' =>$parentutility,   
                            'invoicetype' =>$invoicetype,
                            'amountdue' => $amountdue,
                            'expensetype' => 'Income',
                            'duedate' =>$duedate,
                            'invoicedate' => $invoicedate,
                            'raised_by' => Auth::user()->email,
                            'reviewed_by'=>''
                        ]);

                        }

                      

                     

        return redirect('invoices')->with('status','Invoices for '. $request->utilcateg. ' created Successfully');
 
    }

  //////////////////////////////////// AUTO GENERATE ///////////////////////////////////

    public function autogenerateinvoice()
        {
            $utildetails = Utilitycategories::where('create_invoice',1)->get();
            $today =  Carbon::now();
            $lastDayofMonth =    \Carbon\Carbon::parse($today)->endOfMonth()->toDateString();
  

            
///////// Get all the Utility Types that are allowed to generate Invoice.
        foreach($utildetails as $utilrow)
            {
            
        
            if($utilrow->billcycle =='Units'){
                    $leasedetails = lease::join('houses','houses.id','=','lease.house_id') 
                                     ->join('readings','readings.lease_id','=','lease.id')
                                     ->whereMonth('fromdate', '=',Carbon::parse($today)->month)
                                     ->whereYear('fromdate', '=',Carbon::parse($today)->year)
                                     ->where('lease.status','Active') 
                                     ->select('lease.id','houses.housenumber','readings.amountdue')
                                     ->get();
            }
             elseif($utilrow->billcycle =='Maintenance'){
                    $leasedetails = Lease::join('maintenance','maintenance.lease_id','=','lease.id')
                                                ->join('repairwork','repairwork.maintenance_id','=','maintenance.id')
                                                ->join('houses', 'houses.id', '=', 'lease.house_id')
                                                ->whereMonth('maintenance.created_at', '=',Carbon::parse($today)->month)
                                                ->whereYear('maintenance.created_at', '=',Carbon::parse($today)->year)
                                                ->where('maintenance.billtype','Income')
                                                ->where('repairwork.status','Completed')
                                                ->where('lease.status','Active') 
                                                ->select('lease.id','repairwork.amountspent','repairwork.amountpaid','houses.housenumber')
                                                ->selectRaw('(repairwork.amountspent + repairwork.amountpaid) as totalamount')
                                                ->get();

         
             } else{

                    $leasedetails = lease::join('houses','houses.id','=','lease.house_id') 
                                         ->where('lease.status','Active')              
                                        ->select('lease.id','lease.rent','houses.housenumber')
                                        ->get();
                    }
    ////// Get all the Houses that have an active lease

                foreach($leasedetails as $row){
                    $lease_id = $row->id;    
                    $invoicetype = $utilrow->name;
                
                    if($utilrow->billcycle =='Fromlease'){    
                                $amountdue = $row->rent;               
                    }
                    elseif($utilrow->billcycle =='Permonth'){
                                $amountdue = $utilrow->rate;
                    }
                    elseif($utilrow->billcycle =='Maintenance'){
                                $amountdue = $row->totalamount;
                    }
                    elseif($utilrow->billcycle =='Units'){
                        $amountdue = $row->amountdue;       
                    }
    //// Attach the parent_utility charge to invoice //////////////////////////
                         $parentutilities = Utilitycategories::join('utilitycategory as UT2','utilitycategory.id','=','UT2.parent_utility')
                                        ->where('utilitycategory.name',$invoicetype)
                                        ->select('UT2.name','UT2.rate','UT2.billcycle','UT2.parent_utility')
                                        ->get();

                    
                        $parentutility = array();
                        foreach($parentutilities as $putil){
                            $parentutility[] = array(
                                'utilname' =>$putil->name,
                                'amount' => $putil->rate,
                            );
                        }

                    
                    $invoicedate = $today;
                    $duedate = $lastDayofMonth;

                    $invoicenodate = Carbon::parse($invoicedate)->format('ym');
                
                    $invoice = invoice::updateorCreate([
                            'invoiceno' => $utilrow->prefix.$invoicenodate.$row->housenumber,
                            'lease_id' =>$lease_id,
                            'utilitycategory_id' =>$utilrow->id,
                            'parent_utility' =>$parentutility,  
                            'invoicetype' =>$invoicetype,
                            'amountdue' => $amountdue,
                            'expensetype' => 'Income',
                            'duedate' =>$duedate,
                            'invoicedate' => $invoicedate,
                            'raised_by' => '',
                            'reviewed_by'=>''
                        ]);
                }
                    

            }

          //  return redirect('send-AutoInvoiceEmail/'.$invoice->invoicedate);
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
        $invoice = Invoice::with(['houses','leases','apartments','payments','utilitycategories']) 
                            ->find($id);

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

        $putil = Invoice::select('parent_utility','invoiceno')
                        ->where('lease_id',$lease_id)
                        ->where('invoicetype',$invoicetype)
                        ->where('invoicedate', '<',$invoicedate)
                        ->get();

           
        if($previousbalancedue->totaldue == null){
                $previousbalputil = collect($previousbalancedue);  
                }
        else{
        foreach($putil as $parentU){
            $previousbalputil = collect($parentU->parent_utility);
                
            }
        }
        

        
       
    
        $previousmonthsbalance = ($previousbalancedue->totaldue + $previousbalputil->sum('amount') )- $previousbalancepaid->totalpaid;
        $readings = Readings::whereMonth('fromdate', '=',Carbon::parse($invoicedate)->month)
                            ->whereYear('fromdate', '=',Carbon::parse($invoicedate)->year)
                            ->where('lease_id',$lease_id)
                            ->first();

        $paymenttype = Paymenttypes::where('bank','Safaricom')->first();
        
        $parentutilsum = collect($invoice->parent_utility);
            
        $total = ($invoice->amountdue + $previousmonthsbalance + $parentutilsum->sum('amount')) - $invoice->payments->sum('amountpaid');
	$sentemail = SentEmail::where('item_id',$id)->first();
        
        
       

               
        return view('invoice.invoicedetails',compact('invoice','previousmonthsbalance','readings','parentutilsum','total','paymenttype','sentemail'));
    }

 
}
