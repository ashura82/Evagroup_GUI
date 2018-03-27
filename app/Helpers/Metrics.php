<?php

namespace App\Helpers;

use GuzzleHttp;
use Illuminate\Support\Facades\Cache;

class MetricsHelper {

    private static function getMetrics(){
        $metrics = Cache::remember('metrics_datas', 0.05, function(){
            $client = new GuzzleHttp\Client();
            $url = "http://" . getenv('API_IP') . ":" . getenv('API_PORT') ."/metrics";
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

    public static function getDiskTotal(){
        $metrics = self::getMetrics();
        return $metrics['disk_total'];
    }

    public static function getDiskUsed(){
        $metrics = self::getMetrics();
        return ($metrics['disk_total'] - $metrics['disk_free']);
    }

    public static function getNetworkRx(){
        $metrics = self::getMetrics();
        return $metrics['net_r'];
    }

    public static function getNetworkTx(){
        $metrics = self::getMetrics();
        return $metrics['net_s'];
    }

    public static function getMemAndDisk(){
        $disk_u = self::getDiskUsed();
        $disk_t = self::getDiskTotal();
        $ram_u = self::getMemoryUsed();
        $ram_t = self::getMemoryTotal();
        return json_encode([
            "disk_u" => $disk_u,
            "disk_t" => $disk_t,
            "ram_u" => $ram_u,
            "ram_t" => $ram_t
        ]);
    }

}