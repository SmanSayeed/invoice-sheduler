<?php

namespace App\Console;

use App\Jobs\SendInvoiceReminder;
use App\Models\Invoice;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [];

    protected function schedule(Schedule $schedule)
    {
        // Schedule to check for overdue invoices and send reminders
        $schedule->call(function () {
            // Fetch overdue invoices
            $overdueInvoices = Invoice::where('due_date', '<', now())
                ->where('status', 'pending')
                ->get();

            foreach ($overdueInvoices as $invoice) {
                // Dispatch job to send reminder email
                SendInvoiceReminder::dispatch($invoice);
            }
        })->daily(); // Adjust schedule as per your requirement

        // More scheduled tasks can be added here
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
