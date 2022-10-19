<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\models\invoice;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\EmailController;
use App\models\Utilitycategories;
use App\models\Task;
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
        $task = Task::where('type','invoice')->first();

    if($task->status == 1){
       $controller = new InvoiceController(); 
       $controller->autogenerateinvoice();
       $this->info('Invoice Generated Successfully.');

        $controller = new EmailController(); 
        $controller->AutoinvoiceEmail();
        $this->info('Emails sent Successfully.');
    }else{
        $this->info('Task is Inactive.');
    }
    }
}
