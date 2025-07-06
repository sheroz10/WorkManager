<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Assignment;
use App\Notifications\AssignmentDeadlineReminder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SendAssignmentDeadlineReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-assignment-deadline-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send in-app notifications 30 minutes before assignment deadlines';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $in30 = $now->copy()->addMinutes(30);

        $assignments = Assignment::where('is_done', false)
            ->where('deadline', '>', $now)
            ->where('deadline', '<=', $in30)
            ->get();

        foreach ($assignments as $assignment) {
            $user = $assignment->user;
            $alreadyNotified = DB::table('notifications')
                ->where('notifiable_id', $user->id)
                ->where('type', AssignmentDeadlineReminder::class)
                ->where('data', 'like', '%"assignment_id":'.$assignment->id.'%')
                ->where('data', 'like', '%You have to do this:%')
                ->exists();
            if (!$alreadyNotified) {
                $user->notify(new AssignmentDeadlineReminder($assignment, 'You have to do this: ' . $assignment->title));
            }
        }
    }
}
