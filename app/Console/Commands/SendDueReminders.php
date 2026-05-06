<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;
use App\Jobs\SendReminderEmail;
use Carbon\Carbon;

class SendDueReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders that are due';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all reminders that are due and not yet sent
        $reminders = Reminder::where('is_sent', false)
            ->where('remind_at', '<=', Carbon::now())
            ->get();

        if ($reminders->isEmpty()) {
            $this->info('No reminders to send');
            return;
        }

        foreach ($reminders as $reminder) {
            // Dispatch the job to send email
            SendReminderEmail::dispatch($reminder);
            $this->info("Reminder dispatched for: {$reminder->title}");
        }

        $this->info("Total reminders sent: {$reminders->count()}");
    }
}
