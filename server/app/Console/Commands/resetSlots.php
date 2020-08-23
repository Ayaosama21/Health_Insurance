<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class resetSlots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:resetSlots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Resets the free slots in yesterday's appointments";

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
         DB::table('appointments')->where('day', Carbon::yesterday('Egypt')->format('D'))
        ->update(['free_slots' => DB::raw('slots')]); 

    }
}
