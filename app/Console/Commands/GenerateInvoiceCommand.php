<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\models\invoice;
use App\models\Lease;
use Carbon\Carbon;

class GenerateInvoiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Monthly Invoices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $leasedetails = lease::join('houses','houses.id','=','lease.house_id')
        ->select('lease.id','lease.rent','houses.housenumber')   
          ->get();
       

        foreach ($leasedetails as $key => $row) {
        $lease_id = $row->id;

        $invoicetype = 'AutoRent';
        $amountdue = $row->actualrent;
        $invoicedate = Carbon::now()->addDays(7);
        $duedate = Carbon::now()->addDays(7);

        $invoicenodate = Carbon::parse($invoicedate)->format('ym');

        $invoice= [
        'invoiceno' => 'AUTRENT'.$invoicenodate.$row->housenumber,
        'lease_id' =>$lease_id,
        'invoicetype' =>$invoicetype,
        'amountdue' => $amountdue,
        'status' =>'Unpaid',
        'expensetype' => 'Income',
        'duedate' =>$duedate,
        'invoicedate' => $invoicedate,
        'raised_by' => Auth::user()->email,
        'reviewed_by'=>''
        ];
        $invoice = Invoice::create($invoice);
        $job = (new Invoice($invoice))->delay(now()->addSecond(2));
        dispatch($job);
        $this->info('Generated');
        }
        return 0;
    }
}
