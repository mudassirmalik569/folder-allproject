<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acorn:getpayments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets payments from mydivisions.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = \App\Models\User::whereNotNull('divisions_username')->whereNotNull('divisions_password')->get();
        foreach ($users as $user) {
            \App\Jobs\ScrapePayments::dispatchSync($user);
        }
    }
}
