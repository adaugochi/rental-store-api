<?php

namespace App\Console\Commands;

use App\Http\Services\RentService;
use App\Models\Rent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class CheckLogsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a script to log the following statistics over a period of time (e.g. month or a year) using the logs:';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $rentService =  App::make(RentService::class);
        $logs = $rentService->getLogs();

        info('script', $logs);
        error_log(json_encode($logs));
    }
}
