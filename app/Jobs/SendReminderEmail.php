<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Reminder;
use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendReminderEmail implements ShouldQueue
{
    use Queueable;

    public $reminder;

    /**
     * Create a new job instance.
     */
    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('Sending reminder email', ['reminder_id' => $this->reminder->id, 'email' => $this->reminder->email]);
            
            Mail::send(new ReminderMail($this->reminder));

            Log::info('Email sent successfully', ['reminder_id' => $this->reminder->id]);

            // Mark as sent
            $this->reminder->update(['is_sent' => true]);
            
        } catch (\Exception $e) {
            Log::error('Failed to send reminder email', [
                'reminder_id' => $this->reminder->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
