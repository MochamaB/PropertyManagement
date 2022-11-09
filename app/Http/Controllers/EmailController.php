<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\invoiceMail;
use App\Mail\AutoinvoiceMail;
use App\Mail\receiptMail;
use App\Mail\workorderMail;
use Illuminate\Support\Facades\Mail;
use App\models\invoice;
use App\models\invoiceitems;
use App\Models\Lease;
use App\Models\Tenant;
use App\Models\house;
use App\Models\Utilitycategories;
use App\Models\SentEmail;
use App\Models\Maintenance;
use App\Models\Payments;
use App\Models\Readings;
use App\Models\paymenttypes;
use App\Models\Repairwork;
use PDF;
use Carbon\Carbon;

class EmailController extends Controller
{
    public function invoiceEmail(Request $request,$id,$lease_id,$invoicedate,$invoicetype){

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

        $paymenttype = Paymenttypes::where('bank','Safaricom')->first();

        $parentutilsum = collect($invoice->parent_utility);

        $total = ($invoice->amountdue + $previousmonthsbalance + $parentutilsum->sum('amount')) - $invoice->payments->sum('amountpaid');


        $to = $request->input('mailto');
        $from = $request->input('mailfrom');


/////////////////////   send Email/////////////////////////////////
      
        Mail::to($to)->send(New invoiceMail($invoice,$previousmonthsbalance,$readings,$parentutilsum,$total,$paymenttype));

        ///// update sent email table //////////////////////////
        $sentemail = SentEmail::updateOrCreate(
                [
                     'lease_id'    => $lease_id
                 ], 
                 [
                        'lease_id'  => $request->input('lease_id'),
                        'item_id'  => $request->input('item_id'),
                        'itemno'  => $request->input('itemno'),
                        'mailto' => $invoice->apartments->email,
                        'mailfrom' => Auth::user()->email,
                        'recepientname' => $request->input('recepientname')
                 ]
           
                 );
  
        return View('emails.invoiceEmailView',compact('invoice','previousmonthsbalance','readings','parentutilsum','total','paymenttype'));

    }

    public function receiptMail(Request $request,$id){
        
        
        $payment = payments::with(['houses','leases','apartments','tenants','invoices']) 
        ->find($id);

        $receiptdetails = payments::join('invoices','invoices.id','=','payments.invoice_id')
              ->join('lease','lease.id','=','invoices.lease_id')
              ->join('tenants','tenants.id','=','lease.tenant_id')
              ->join('houses','houses.id','=','lease.house_id')
              ->join('apartment','apartment.id','=','lease.apartment_id')
              ->select('payments.invoice_id','payments.invoiceno','payments.receiptno','payments.paymentitem','payments.lease_id','tenants.firstname','tenants.lastname'
                    ,'houses.housenumber','tenants.idnumber','tenants.email','tenants.phonenumber','invoices.invoicedate','invoices.duedate','invoices.invoiceno',
                    'payments.created_at','invoices.amountdue','payments.amountpaid','apartment.name','apartment.logo','apartment.postalcode','apartment.location',
                    'apartment.email as apemail','apartment.authorized_person')
                                ->where('payments.invoice_id',$id)
                                ->first();
            $receiptpayments = payments::select('invoiceno','created_at','receiptno','amountpaid')
                            ->selectRaw('SUM(amountpaid) as totalpaid')
                        ->where('invoice_id',$id)
                        ->groupBy('invoiceno','created_at','receiptno','amountpaid')
                            ->get();
            $parentutilsum = collect($receiptdetails->parent_utility);

        $to = $request->input('mailto');
        $from = $request->input('mailfrom');

        /////////////////////   send Email/////////////////////////////////
      
        Mail::to($to)->send(New receiptMail($payment,$receiptdetails,$receiptpayments,$parentutilsum));

        $sentemail = SentEmail::updateOrCreate(
            [
                 'item_id'    => $id
             ], 
             [
                    'lease_id'  => $request->input('lease_id'),
                    'item_id'  => $request->input('item_id'),
                    'itemno'  => $request->input('itemno'),
                    'mailto' => $request->input('mailto'),
                    'mailfrom' => Auth::user()->email,
                    'recepientname' => $request->input('recepientname')
             ]
       
             );
      
        return View('emails.receiptEmailView',compact('receiptdetails','receiptpayments','payment','parentutilsum'));


    }

    public function workorderMail(Request $request, $maintenance_id){

        $workorder = Maintenance::join('lease','lease.id','=','maintenance.lease_id')
        ->join('houses', 'houses.id', '=', 'lease.house_id')
        ->join('tenants','tenants.id','=','lease.tenant_id')
        ->join('repairwork','repairwork.maintenance_id','=','maintenance.id')
        ->select('tenants.firstname','tenants.lastname','tenants.email','houses.housenumber','tenants.idnumber','tenants.phonenumber',
                  'maintenance.name','repairwork.assignedto','maintenance.created_at','maintenance.priority','maintenance.description',
                  'maintenance.id','maintenance.lease_id','repairwork.Workid','repairwork.maintenance_id','repairwork.status','repairwork.amountpaid','repairwork.amountpaid',
                  'repairwork.dateofrepair','repairwork.assignedto')
                  ->where('maintenance.id', '=',$maintenance_id)
                  ->first();
        
                  $to = $request->input('mailto');
                  $from = Auth::user()->email;

        Mail::to($to)->send(New workorderMail($workorder));

        $sentemail = SentEmail::updateOrCreate(
            [
                 'lease_id'    => $workorder->lease_id
             ], 
             [
                    'lease_id'  => $request->input('lease_id'),
                    'item_id'  => $request->input('item_id'),
                    'itemno'  => $request->input('itemno'),
                    'mailto' => $request->input('mailto'),
                    'mailfrom' => Auth::user()->email,
                    'recepientname' => $request->input('recepientname')
             ]
       
             );

        return View('emails.workorderEmailView',compact('workorder'));
    }

    public function previewEmail($id,$lease_id,$invoicedate,$invoicetype){
        $invoicedetails= invoice::join('lease','lease.id','=','invoices.lease_id')
        ->join('houses','houses.id','=','lease.house_id')
        ->join('tenants','tenants.id','=','lease.tenant_id')
        ->select('invoices.invoiceno','houses.housenumber','tenants.firstname','tenants.lastname','tenants.idnumber',
                'tenants.email','tenants.phonenumber','invoices.invoicedate','Invoices.duedate','Invoices.status','invoices.amountdue','invoices.invoicetype')
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

        $date = \Carbon\Carbon::parse($invoicedate)->format('d M Y');
       

        view()->share('emails.invoicepdf',$invoicedetails,$previousmonthsbalance,$paymenttypes,$utilitycat,$readings,$watercharge,$paymentsinfo);
        $pdf = PDF::loadView('emails.invoicepdf', compact('invoicedetails','previousmonthsbalance','paymenttypes','utilitycat','readings','watercharge','paymentsinfo','sentemail'));
        return $pdf->download($invoicetype.'-'.$date.'-invoice.pdf');

        
  
        
    }

    public function sentInvoiceEmails(Request $request){

        $sent = SentEmail::join('lease','lease.id','=','sentemails.lease_id')
                        ->join('houses','houses.id','=','lease.house_id')
                        ->select('sentemails.itemno','sentemails.recepientname','houses.housenumber','sentemails.created_at')
                        ->get();

        return view('emails.sentemailInvoice',compact('sent'));
    }


    public function autoinvoiceEmail(){

        $invoicedate =  Carbon::now();
        $invoicelist = Invoice::with(['houses','leases','apartments','payments','utilitycategories','tenants'])
                              ->whereYear('invoices.invoicedate', '=', Carbon::parse($invoicedate)->year)
                              ->whereMonth('invoices.invoicedate', '=', Carbon::parse($invoicedate)->month)
                       ->get();

        foreach($invoicelist as $invoice){

            $previousbalancedue = invoice::selectRaw('SUM(amountdue) as totaldue')
                       ->where('lease_id',$invoice->lease_id)
                       ->where('invoicetype',$invoice->invoicetype)
                       ->where('invoicedate', '<',$invoice->invoicedate)
                       ->first();
            
            $previousbalancepaid = payments::selectRaw('SUM(amountpaid) as totalpaid')
                        ->where('lease_id',$invoice->lease_id)
                        ->where('paymentitem',$invoice->invoicetype)
                        ->where('invoicedate', '<',$invoice->invoicedate)
                        ->first();

            $putil = Invoice::select('parent_utility','invoiceno')
                        ->where('lease_id',$invoice->lease_id)
                        ->where('invoicetype',$invoice->invoicetype)
                        ->where('invoicedate', '<',$invoice->invoicedate)
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
            $readings = Readings::whereMonth('fromdate', '=',Carbon::parse($invoice->invoicedate)->month)
                                ->whereYear('fromdate', '=',Carbon::parse($invoice->invoicedate)->year)
                                ->where('lease_id',$invoice->lease_id)
                                ->first();

            $paymenttype = Paymenttypes::where('bank','Safaricom')->first();

            $parentutilsum = collect($invoice->parent_utility);

            $total = ($invoice->amountdue + $previousmonthsbalance + $parentutilsum->sum('amount')) - $invoice->payments->sum('amountpaid');

            $to = $invoice->tenants->email;
            $from = $invoice->apartments->email;
            
            Mail::to($to)->send(New AutoinvoiceMail($invoice,$previousmonthsbalance,$readings,$parentutilsum,$total,$paymenttype));

            $sentemail = SentEmail::updateOrCreate(
                [
                     'item_id'    => $invoice->id
                 ], 
                 [
                        'lease_id'  => $invoice->lease_id,
                        'item_id'  => $invoice->id,
                        'itemno'  => $invoice->invoiceno,
                        'mailto' => $to,
                        'mailfrom' => $from,
                        'recepientname' => $invoice->tenants->firstname.''.$invoice->tenants->lastname
                 ]
           
                 );

        }


    }
}
