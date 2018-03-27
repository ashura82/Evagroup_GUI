<?php

namespace App\Helpers\Nginx;

use GuzzleHttp;

class StatusHelper {

    public static function get(){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') ."/nginx_status";
        dd($url);
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return collect(json_decode($res->getBody()->getContents()));
        } else {
            throw new \Exception('Impossible de récupérer les Vhosts');
        }
    }

}