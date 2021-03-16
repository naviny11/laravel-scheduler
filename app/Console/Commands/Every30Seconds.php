<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Log;

class Every30Seconds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'every30seconds:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This script will run every 30 seconds';

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
        Log::channel('scheduler')->info('Initiating process status check');
        //Check if any process is already initiated..
        $count = DB::table('process_status')
                ->where('status','=',0)
                ->count();
        
        //If a process is already initiated then exit the execution
        if($count) {
            echo "Process already running.";
            Log::channel('scheduler')->info('Exited : Because process already running.');
            exit();
        } else {

            //Make an entry into the process_status table before initiating a process
            echo "Starting process";
            Log::channel('scheduler')->info('No process running..');
            Log::channel('scheduler')->info('Starting process..');
            $processId = DB::table('process_status')->insertGetId([
                'start_time' => now(),
                'status' => 0
            ]);
            
            //Generate a random string and insert into the table.
            $randomString = 'test';
            DB::table('random')->insert([
                'value' => $randomString,
                'created_tms' => now()
            ]);

            echo "\nValue inserted in DB";
            Log::channel('scheduler')->info('Value inserted in DB..');
            //sleep(45) is added to mimic that the process is running for 45 seconds 
            //before completing..
            sleep(75);

            //After 45 seonds have passed update the process status in table
            DB::table('process_status')->where('id',$processId)->update(array(
                'end_time'=>now(),
                'status' => 1
                ));
            echo "\nProcess end...";
            Log::channel('scheduler')->info('Ending process..');
        }
    }
}
