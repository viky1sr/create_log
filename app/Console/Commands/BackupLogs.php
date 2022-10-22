<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class BackupLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Artisan::call('backup:run --only-files');
        $this->info('Success backup logs '.Carbon::now()->format('Y-m-d'));
    }
}
