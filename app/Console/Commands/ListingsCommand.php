<?php

namespace App\Console\Commands;

use App\Http\Controllers\ListingController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ListingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listings:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Orbost listings';

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
        $c = new ListingController();
        $c->getactive();
        //Log::notice( "task is running" );
    }
}
