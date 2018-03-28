<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    function index(){
        return view('index');
    }

    function log(Input $input){
        $file = $input->get('file');
        if($file == 'daemon.log' || $file == 'lfd.log' || $file == 'auth.log') {
            $url = 'logs';
        }
        if($file == 'csf.allow' || $file == 'csf.deny') {
            $url = 'logs_csf';
        }
        if(isset($url)) {
            $client = new GuzzleHttp\Client();
            $url = "http://" . getenv('API_IP') . ":" . getenv('API_PORT') . "/" . $url . "/" . $file;
            $res = $client->get($url);
            if($res->getStatusCode() == 200){
                return $res->getBody()->getContents();
            } else {
                throw new \Exception("Impossible de voir le fichier");
            }
        }
        return null;
    }
}
