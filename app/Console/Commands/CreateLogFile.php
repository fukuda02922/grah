<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class CreateLogFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create log file.';

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
     * @return mixed
     */
    public function handle()
    {
        //
        Storage::disk('local')->put(date("Ymd_His").'.txt', 'message');
    }
}
