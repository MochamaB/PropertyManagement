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

         
         return view('invoice.index', compact('yearinvoicegrouping','categoryitems')); 
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

        return view('invoice.index', compact('invoicegrouping','invtype','invoicetype','categoryitems')); 

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
                                          'invoices.invoiceno','invoices.invoicetype'
                                    )
                                    ->with('payments')
                                    ->where('invoices.invoicetype',$invoicetype)
                                    ->whereYear('invoices.invoicedate', '=', Carbon::parse($year)->year)
                                    ->whereMonth('invoices.invoicedate', '=', Carbon::parse($month)->month)
                                    
                                    
                                          ->get();
        $invoice = Invoice::where('invoices.invoicetype',$invoicetype)->first();
      
         return view('invoice.ListInvoice',compact('details','invoice','categoryitems'));
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
                
           
        
        

         if($utildetails->billcycle =='Units'){
                $leasedetails = lease::join('houses','houses.id','=','lease.house_id') 
                                 ->join('readings','readings.lease_id','=','lease.id')
                                 ->where('readings.utilitycategory_id',$utildetails->id)
                                 ->whereMonth('fromdate', '=',Carbon::parse($invoicedate)->month)
                                 ->whereYear('fromdate', '=',Carbon::parse($invoicedate)->year)
                                 ->select('lease.id','houses.housenumber','readings.amountdue')
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
                   
                    invoice::updateorCreate([
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

                      

                     

        return redirect('/invoices')->with('status','Invoices for '. $request->utilcateg. ' created Successfully');
 
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
        
        $previousmonthsbalance = $previousbalancedue->totaldue - $previousbalancepaid->totalpaid;

        $readings = Readings::whereMonth('fromdate', '=',Carbon::parse($invoicedate)->month)
                            ->whereYear('fromdate', '=',Carbon::parse($invoicedate)->year)
                            ->where('lease_id',$lease_id)
                            ->first();
        $parentutility = Utilitycategories::join('utilitycategory as UT2','utilitycategory.id','=','UT2.parent_utility')
                        ->join('readings','utilitycategory.id','=','readings.utilitycategory_id') 
                        ->where('utilitycategory.name',$invoicetype)
                        ->whereMonth('readings.fromdate', '=',Carbon::parse($invoicedate)->month)
                            ->whereYear('readings.fromdate', '=',Carbon::parse($invoicedate)->year)
                            ->where('readings.lease_id',$lease_id)
                        ->select('UT2.name','UT2.rate','readings.amountdue','UT2.billcycle')
                        ->get();


               
        return view('invoice.invoicedetails',compact('invoice','previousmonthsbalance','readings','parentutility'));
    }

 
}
