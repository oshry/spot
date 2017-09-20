<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MainController;

class Simulate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simulate:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'simulates the amount of requests';

    /**
     * Create a new command instance.
     *
     * @return void
     */


    public function __construct()
    {
        parent::__construct();
        $this->main = new MainController();
//        $this->fork = new \duncan3dc\Forker\Fork;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $r = $this->main->current_status['requests'];
        for($i = 1 ; $r >=$i; $i++){
                $main = new MainController();
                $res = $main->runner();
                echo $res['status']."\n";
        }
        echo "End\n";
        die;
    }
    //multi thread sharing memory example
//    public function nice()
//    {
//        $r = $this->main->current_status['requests'];
//        for($i = 1 ; $r >=$i; $i++){
//            $this->fork->call(function () {
//                $main = new MainController();
//                $res = $main->runner();
//                echo $res['status']."\n";
//                sleep(1);
//            });
//        }
//        echo "Waiting for the threads to finish...\n";
//        $this->fork->wait();
//        echo "End\n";
//        die;
//    }
}
