<?php

namespace App\Helpers;

use GuzzleHttp;
use Illuminate\Support\Facades\Cache;

class MetricsHelper {

    private static function getMetrics(){
        $metrics = Cache::remember('metrics_datas', 0.05, function(){
            $client = new GuzzleHttp\Client();
            $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') ."/metrics";
            $res = $client->get($url);
            if($res->getStatusCode() == 200){
                return collect(json_decode($res->getBody()->getContents()));
            } else {
                throw new \Exception('Impossible de récupérer les Vhosts');
            }
        });
        return $metrics;
    }

    public static function getCpu(){
        $metrics = self::getMetrics();
        return $metrics['cpu'];
    }

    public static function getMemoryUsed(){
        $metrics = self::getMetrics();
        return $metrics['mem_u'];
    }

    public static function getMemoryTotal(){
        $metrics = self::getMetrics();
        return $metrics['mem_t'];
    }

    public static function getNetworkRx(){
        $metrics = self::getMetrics();
        return $metrics['net_r'];
    }

    public static function getNetworkTx(){
        $metrics = self::getMetrics();
        return $metrics['net_s'];
    }

}