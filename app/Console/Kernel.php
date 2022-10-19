<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Task;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        'App\Console\Commands\GenerateInvoiceCommand'
      ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $tasks = Task::where('type','invoice')->first();
        
            $frequency = $tasks->frequency;
            $date = $tasks->date;
            $time = $tasks->time;
        $schedule->command('generate:invoice')->$frequency($date, $time);
        // $schedule->command('inspire')->hourly();
    
        

        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
