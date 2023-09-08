<?php

namespace App\Console\Commands;

use App\Jobs\CheckUserJob;
use Illuminate\Console\Command;

class CheckUserCommand extends Command
{

    protected $signature = 'check:user';
    protected $description = 'Dispatch CheckUserJob every 10 minutes';


    public function handle()
    {
        CheckUserJob::dispatch();
        $this->info('CheckUserJob dispatched successfully.');
    }
}
