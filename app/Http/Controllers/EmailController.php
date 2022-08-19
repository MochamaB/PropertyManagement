<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\invoiceMail;
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

class EmailController extends Controller
{
    public function invoiceEmail(Request $request,$id,$lease_id,$invoicedate,$invoicetype){
        $invoicedetails= invoice::join('lease','lease.id','=','invoices.lease_id')
        ->join('houses','houses.id','=','lease.houseID')
        ->join('tenants','tenants.id','=','lease.tenantID')
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

        $to = $request->input('mailto');
        $from = $request->input('mailfrom');


/////////////////////   send Email/////////////////////////////////
      
        Mail::to($to)->send(New invoiceMail($invoicedetails,$previousmonthsbalance,$paymenttypes,$utilitycat,$readings,$watercharge,$paymentsinfo));

        ///// update sent email table //////////////////////////
        $sentemail = SentEmail::updateOrCreate(
                [
                     'lease_id'    => $lease_id
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
  
        return View('emails.invoiceEmailView',compact('invoicedetails','previousmonthsbalance','paymenttypes','utilitycat','readings','watercharge','paymentsinfo'));

    }

    public function receiptMail(Request $request, $invoice_id){
        
        
        $receiptdetails = payments::join('invoices','invoices.id','=','payments.invoice_id')
                                  ->join('lease','lease.id','=','invoices.lease_id')
                                  ->join('tenants','tenants.id','=','lease.tenantID')
                                  ->join('houses','houses.id','=','lease.houseID')
             ->select('payments.lease_id','payments.invoiceno','payments.receiptno','payments.paymentitem','tenants.firstname','tenants.lastname'
                      ,'houses.housenumber','tenants.idnumber','tenants.email','tenants.phonenumber','invoices.invoicedate','invoices.duedate',
                      'payments.created_at','invoices.amountdue','payments.amountpaid')
                                  ->where('payments.invoice_id',$invoice_id)
                                  ->first();
        $receiptpayments = payments::select('invoiceno','created_at','receiptno','amountpaid')
                                    ->selectRaw('SUM(amountpaid) as totalpaid')
                                   ->where('invoice_id',$invoice_id)
                                   ->groupBy('invoiceno','created_at','receiptno','amountpaid')
                                    ->get();

        $to = $request->input('mailto');
        $from = Auth::user()->email;

        /////////////////////   send Email/////////////////////////////////
      
        Mail::to($to)->send(New receiptMail($receiptdetails,$receiptpayments));

        $sentemail = SentEmail::updateOrCreate(
            [
                 'lease_id'    => $receiptdetails->lease_id
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
        return View('emails.receiptEmailView',compact('receiptdetails','receiptpayments'));


    }

    public function workorderMail(Request $request, $maintenance_id){

        $workorder = Maintenance::join('lease','lease.id','=','maintenance.lease_id')
        ->join('houses', 'houses.id', '=', 'lease.houseID')
        ->join('tenants','tenants.id','=','lease.tenantID')
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
        ->join('houses','houses.id','=','lease.houseID')
        ->join('tenants','tenants.id','=','lease.tenantID')
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
                        ->join('houses','houses.id','=','lease.houseID')
                        ->select('sentemails.itemno','sentemails.recepientname','houses.housenumber','sentemails.created_at')
                        ->get();

        return view('emails.sentemailInvoice',compact('sent'));
    }
}
