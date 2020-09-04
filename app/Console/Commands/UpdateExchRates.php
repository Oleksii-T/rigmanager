<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateExchRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update exchange rates.';

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
     * @return int
     */
    public function handle()
    {
        try {
            \App\Http\Controllers\UsdExchangeController::update();
            $log = '[' . \Carbon\Carbon::now() . '] Rates updated successfully.
';
            echo ($log);
        } catch (\Throwable $th) {
            $log = '[' . \Carbon\Carbon::now() . '] Rates updating fails. Error message: ';
            echo($log.$th->getMessage());
        }
    }
}
