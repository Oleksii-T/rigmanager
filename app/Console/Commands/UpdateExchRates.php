<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
            Log::channel('single')->info('[custom.info][rates.update] Rates updated successfully');
        } catch (\Throwable $th) {
            Log::channel('single')->error('[custom.error][rates.update] Rates updating fails. '.$th->getMessage());
        }
    }
}
