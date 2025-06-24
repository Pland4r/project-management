<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EssaiMessure;
use Illuminate\Support\Facades\Mail;
use App\Mail\EssaiMessureReminderMail;

class SendEssaiMessureReminders extends Command
{
    protected $signature = 'reminders:essai-messure';
    protected $description = 'Send essai/messure reminders one month before start date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $targetDate = now()->addMonth()->toDateString();
        \Log::info("🕵️ Checking for essai/messures starting on: ".$targetDate);

        \DB::enableQueryLog();

        $essaiMessures = EssaiMessure::whereDate('start_date', $targetDate)
            ->with('user')
            ->get();

        \Log::info("📊 Found essai/messures: ".$essaiMessures->count());
        \Log::debug("🔍 SQL Query: " . json_encode(\DB::getQueryLog()));

        foreach ($essaiMessures as $essaiMessure) {
            if ($essaiMessure->user && $essaiMessure->user->email) {
                \Log::info("✉️ Attempting to send for essai/messure: ".$essaiMessure->id);
                Mail::to($essaiMessure->user->email)->send(new EssaiMessureReminderMail($essaiMessure));
            }
        }
    }
}