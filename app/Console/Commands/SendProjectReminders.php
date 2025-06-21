<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectReminderMail;

class SendProjectReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send project reminders one month before start date';

    public function __construct()
    {
        parent::__construct();
    }
    
// In SendProjectReminders.php
public function handle()
{
    $targetDate = now()->addMonth()->toDateString();
    \Log::info("🕵️ Checking for projects starting on: ".$targetDate);

    // Add raw SQL logging
    \DB::enableQueryLog();
    
    $projects = Project::whereDate('start_date', $targetDate)
        ->with('user')
        ->get();

    \Log::info("📊 Found projects: ".$projects->count());
    \Log::debug("🔍 SQL Query: " . json_encode(\DB::getQueryLog()));

    foreach ($projects as $project) {
        \Log::info("✉️ Attempting to send for project: ".$project->id);
        Mail::to($project->user->email)->send(new ProjectReminderMail($project));
    }
}

}