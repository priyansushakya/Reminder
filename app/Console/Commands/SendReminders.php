<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Reminder;
use App\Jobs\SendReminderEmail;

#[Signature('app:send-reminders')]
#[Description('Command description')]
class SendReminders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
{
    $reminders = Reminder::where('remind_at', '<=', now())
        ->where('is_sent', false)
        ->get();

    foreach ($reminders as $reminder) {
        SendReminderEmail::dispatch($reminder);
    }
}
}
