<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Scrape payments every day at 1200 EST.
        $schedule->job(function () {
            $users = \App\Models\User::whereNotNull('divisions_username')->whereNotNull('divisions_password')->get();
            foreach ($users as $user) {
                \App\Jobs\ScrapePayments::dispatchSync($user);
            }
        })->dailyAt('16:00');

        // Scrape workorders every ten minutes.
        $schedule->job(function () {
            $users = \App\Models\User::whereNotNull('divisions_username')->whereNotNull('divisions_password')->get();
            foreach ($users as $user) {
                \App\Jobs\ScrapeWorkorders::dispatchSync($user);
            }
        })->everyTenMinutes();
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
