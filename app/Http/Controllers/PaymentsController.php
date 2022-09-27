<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\invoice;
use App\models\paymenttypes;
use App\models\payments;
use App\models\SentEmail;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Faker\Provider\ar_EG\Payment;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $paymentitems = Payments::distinct()->get(['paymentitem']);

        $yearpaymentgrouping = payments::join('invoices','invoices.id','=','payments.invoice_id')
                                        ->selectRaw('year(payments.invoicedate) as year, payments.paymentitem,
                                                        count(DISTINCT payments.invoiceno) as noofpayments')
                                         ->selectRaw('SUM(payments.amountpaid) as totalamountpaid')
                                         ->groupBy('year','payments.paymentitem')
                                         ->orderBy('year','desc')
                                         ->get();

        

        return view('payments.index',compact('yearpaymentgrouping','paymentitems')); 
    }
    public function indexmonth($year,$paymentitem)
    {
        ///////////// get the month view for all payments
        $paymentitems = Payments::distinct()->get(['paymentitem']);

        $paymentgrouping = payments::selectRaw('year(payments.invoicedate) as year, monthname(payments.invoicedate) as month, payments.paymentitem,
                                        count(DISTINCT payments.receiptno) as noofpayments')
                                ->selectRaw('SUM(payments.amountpaid) as totalamountpaid')     
                            ->where('payments.paymentitem',$paymentitem)
                            ->whereYear('payments.invoicedate', '=', Carbon::parse($year)->year)
                            ->groupBy('year', 'month','payments.paymentitem')
                            ->orderBy('month','asc')
                            ->get();
        
       
        

        return view('payments.index', compact('paymentgrouping','paymentitems')); 

    }

    public function Listpayments($year,$month,$paymentitem)
    {
    $paymentitems = Payments::distinct()->get(['paymentitem']);

     $details = Payments::join('invoices','invoices.id','=','payments.invoice_id')
                                ->join('lease','lease.id','=','Invoices.lease_id')
                                 ->join('houses', 'houses.id', '=', 'lease.house_id')
                                 ->join('tenants','tenants.id','=','lease.tenant_id')
                                 ->join('paymenttypes','payments.paymenttype_id','=','paymenttypes.id')
                                 ->select('payments.id','payments.invoice_id','payments.receiptno','tenants.firstname','tenants.lastname','tenants.email','houses.housenumber','invoices.lease_id',
                                          'payments.created_at','invoices.duedate','invoices.invoicedate','payments.amountpaid',
                                          'payments.invoiceno','invoices.invoicetype','paymenttypes.paymentname'
                                    )
                                    ->where('payments.paymentitem',$paymentitem)
                                    ->whereYear('invoices.invoicedate', '=', Carbon::parse($year)->year)
                                    ->whereMonth('invoices.invoicedate', '=', Carbon::parse($month)->month)
                                    
                                    
                                          ->get();
      
         return view('payments.ListPayments',compact('details','paymentitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$lease_id,$invoicedate,$invoicetype)
    {
         $invoice = invoice::with('payments')->find($id);

         $parentutilsum = collect($invoice->parent_utility);
         
         $paymenttypes = paymenttypes::all();
        return view('payments.create', compact('invoice','paymenttypes','parentutilsum')); 
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
            'amountpaid' => 'required|numeric',
            'paymenttype_id' => 'required'
           
        ], [
            'amountpaid.required' => 'This field is required',
            'amountpaid.numeric' => 'Input Numbers Only',
            'paymenttype_id.required'=> 'This field is required',
         

        ]);
        $prefix = "RCT";
        $recordnounique = IdGenerator::generate(['table' => 'payments','field' => 'receiptno', 'length' => 4, 'prefix' =>$prefix]);

        $payments = new payments;
        $payments->invoice_id = $request->input('invoice_id');
        $payments->lease_id = $request->input('lease_id');
        $payments->invoiceno = $request->input('invoiceno');
        $payments->receiptno = $recordnounique.$request->input('invoiceno');
        $payments->paymenttype_id = $request->input('paymenttype_id');
        $payments->payment_code = $request->input('payment_code');
        $payments->paymentitem = $request->input('paymentitem');
        $payments->amountpaid = $request->input('amountpaid');
        $payments->received_by = Auth::user()->email;
        $payments->invoicedate = $request->input('invoicedate');
        $payments->save();

        $date = \Carbon\Carbon::parse($payments->invoicedate);
        $month = \Carbon\Carbon::parse($payments->invoicedate)->format('M');
        $year = $date->year;
        
        return redirect('payments/Listpayments/'.$year. '/' . $month. '/' . $payments->paymentitem)->with('status','Payment Made Successfully');
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
        $invoice = invoice::with('payments')->find($id);
        $Payments = Payments::find($id);
         
         $paymenttypes = paymenttypes::all();

        return view('payments.edit', compact('invoice','paymenttypes','Payments'));
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
            'amountpaid' => 'required|numeric',
            'paymenttype_id' => 'required',
     
        ], [
            'amountpaid.required' => 'This field is required',
            'amountpaid.numeric' => 'Enter numbers only',
            'paymenttype_id.required' => 'This field is required',
    
        ]);
        $payment = Payments::find($id);
        $payment->amountpaid = $request->input('amountpaid'); 
        $payment->paymenttype_id = $request->input('paymenttype_id'); 
        $payment->update();

        $date = \Carbon\Carbon::parse($payment->invoicedate);
        $month = \Carbon\Carbon::parse($payment->invoicedate)->format('M');
        $year = $date->year;

        return redirect('payments/Listpayments/'.$year. '/' . $month. '/' . $payment->paymentitem)->with('status','Payment Edited Successfully'); 
    
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

    public function details($id,$lease_id,$invoicedate,$invoicetype)
    {
        $payment = payments::with(['houses','leases','apartments','tenants','invoices']) 
                            ->find($id);

        $receiptdetails = payments::join('invoices','invoices.id','=','payments.invoice_id')
                                  ->join('lease','lease.id','=','invoices.lease_id')
                                  ->join('tenants','tenants.id','=','lease.tenant_id')
                                  ->join('houses','houses.id','=','lease.house_id')
                                  ->join('apartment','apartment.id','=','lease.apartment_id')
             ->select('payments.invoice_id','payments.invoiceno','payments.receiptno','payments.paymentitem','tenants.firstname','tenants.lastname'
                      ,'houses.housenumber','tenants.idnumber','tenants.email','tenants.phonenumber','invoices.invoicedate','invoices.duedate','invoices.invoiceno',
                      'payments.created_at','invoices.amountdue','payments.amountpaid','apartment.name','apartment.logo','apartment.postalcode','apartment.location',
                      'apartment.email')
                                  ->where('payments.invoice_id',$id)
                                  ->first();
        $receiptpayments = payments::select('invoiceno','created_at','receiptno','amountpaid')
                                    ->selectRaw('SUM(amountpaid) as totalpaid')
                                   ->where('invoice_id',$id)
                                   ->groupBy('invoiceno','created_at','receiptno','amountpaid')
                                    ->get();
        $parentutilsum = collect($receiptdetails->parent_utility);

       

    return view('payments.receiptdetails',compact('receiptdetails','receiptpayments','payment','parentutilsum'));
    }
}
