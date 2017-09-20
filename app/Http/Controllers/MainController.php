<?php

namespace App\Http\Controllers;

use App\Status;
use App\StatusRequest;
//use App\Http\Controllers\Controller;
//use Illuminate\Http\Response;
use Response;
use Illuminate\Http\Request;
//use Illuminate\Routing\ResponseFactory;


class MainController extends Controller
{
    public $current_status = [];
    public $current_odds = [];
    public $status = 200;
    /**
     * @return boolean
     */
    public function __construct()
    {
        $current_status = Status::current_status();
        foreach ($current_status as $item) {
            $this->current_status['status'] = $item->status;
            $this->current_status['requests'] = $item->requests;
        }
        $odds = $this->calculate_odds();
        $rand = mt_rand(1,100);
        $this->status = $odds[$rand];
    }
    public function index(){
        return response()->json(['status'=>$this->status], $this->status);
    }

    public function runner(){
        $response['status'] = $this->status;
        return $response;
    }

    private function calculate_odds(){
        $current_odds = StatusRequest::current_odds($this->current_status['status']);
        $i = 0;
        $odds = [];
        $odds_key = 1;
        foreach ($current_odds as $item) {
            $this->current_odds[$i]['code'] = $item->code;
            $this->current_odds[$i]['percent'] = $item->percent;
            for ($j = 0 ; $j < $item->percent; $j++){
                $odds[$odds_key] = $item->code;
                $odds_key++;
            }
            $i++;
        }
        return $odds;
    }

    private function http_response($url, $status = null, $wait = 3)
    {
        $time = microtime(true);
        $expire = $time + $wait;

        // we fork the process so we don't have to wait for a timeout
        $pid = pcntl_fork();
        if ($pid == -1) {
            die('could not fork');
        } else if ($pid) {
            // we are the parent
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $head = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if(!$head)
            {
                return FALSE;
            }

            if($status === null)
            {
                if($httpCode < 400)
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
            elseif($status == $httpCode)
            {
                return TRUE;
            }

            return FALSE;
            pcntl_wait($status); //Protect against Zombie children
        } else {
            // we are the child
            while(microtime(true) < $expire)
            {
                sleep(0.5);
            }
            return FALSE;
        }
    }
}