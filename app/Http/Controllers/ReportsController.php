<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Invoice;
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
class ReportsController extends Controller
{

    public function index(){

    
        $category = collect(['Invoices','Payments']);
        

        return view('reports.index',compact('category'));
    }

    public function view(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'startdate' => 'required',
            'enddate' => 'required'
           
        ], [
            'category.required' => 'This field is required',
            'startdate.required' => 'This field is required',
            'enddate.required'=> 'This field is required',
         

        ]);
        if($request->category =='Invoices')
        {
            $reportyype = $request->category;
            $report = invoice::join('lease','lease.id','=','Invoices.lease_id')
            ->join('houses', 'houses.id', '=', 'lease.house_id')
            ->join('tenants','tenants.id','=','lease.tenant_id')
            ->select('invoices.id','tenants.firstname','tenants.lastname','tenants.email','houses.housenumber','invoices.lease_id',
                     'invoices.created_at','invoices.duedate','invoices.invoicedate','invoices.amountdue',
                     'invoices.invoiceno','invoices.invoicetype','invoices.parent_utility'
               )
               ->with('payments')
               ->where('invoices.invoicedate','>=',$request->startdate)
               ->where('invoices.invoicedate','<=',$request->enddate)
               ->get();

               foreach($report as $item){
                $parentutilsum = collect($item->parent_utility);
                
        }
        }elseif($request->category =='Payments')
        {
            $reportyype = $request->category;
            $report =  Payments::join('invoices','invoices.id','=','payments.invoice_id')
                                ->join('lease','lease.id','=','Invoices.lease_id')
                                 ->join('houses', 'houses.id', '=', 'lease.house_id')
                                 ->join('tenants','tenants.id','=','lease.tenant_id')
                                 ->join('paymenttypes','payments.paymenttype_id','=','paymenttypes.id')
                                 ->select('payments.id','payments.invoice_id','payments.receiptno','tenants.firstname','tenants.lastname','tenants.email','houses.housenumber','invoices.lease_id',
                                          'payments.created_at','invoices.duedate','invoices.invoicedate','payments.amountpaid','payments.paymentitem',
                                          'payments.invoiceno','invoices.invoicetype','paymenttypes.paymentname','payments.payment_code','invoices.parent_utility'
                                    )
                                    ->where('payments.invoicedate','>=',$request->startdate)
                                    ->where('invoices.invoicedate','<=',$request->enddate)
                                    ->get();

                                    
                                        $parentutilsum = 0;
                                    

        }

       
        return view('reports.view',compact('reportyype','report','parentutilsum'));
    }
}
