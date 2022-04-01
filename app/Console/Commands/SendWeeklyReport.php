<?php

namespace App\Console\Commands;

use App\Notifications\WeeklyReportNotification;
use App\Repositories\User\UserRepoInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendWeeklyReport extends Command
{
    protected $userRepo;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly report for admin by email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepoInterface $userRepo)
    {
        parent::__construct();

        $this->userRepo = $userRepo;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $admins = $this->userRepo->getAllAdminAccounts();
        $numberOfNewUsers = $this->userRepo->countNewUsersByWeek();

        $admins->each(function ($admin) use ($numberOfNewUsers) {
            Notification::send(
                $admin,
                new WeeklyReportNotification($admin->full_name, $numberOfNewUsers)
            );
        });
    }
}
