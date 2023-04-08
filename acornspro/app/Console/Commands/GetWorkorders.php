<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetWorkorders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acorn:getworkorders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets workorders from mydivisions.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = \App\Models\User::whereNotNull('divisions_username')->whereNotNull('divisions_password')->get();
        foreach ($users as $user) {
            \App\Jobs\ScrapeWorkorders::dispatchSync($user);
        }
    }
}
