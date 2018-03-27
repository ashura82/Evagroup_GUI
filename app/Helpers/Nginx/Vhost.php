<?php

namespace App\Helpers\Nginx;

use GuzzleHttp;
use RomanPitak\Nginx\Config\Scope;
use RomanPitak\Nginx\Config\Text;

class VhostHelper {

    public static function all(){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') ."/view_vhosts";
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return collect(json_decode($res->getBody()->getContents()));
        } else {
            throw new \Exception('Impossible de récupérer les Vhosts');
        }
    }

    public static function get($key){
        if(!$key){
            throw new \Exception('Pas de clé');
        }
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') ."/details/" . $key;
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            try{
                $tmp = $res->getBody()->getContents();
                $tmp = collect(GuzzleHttp\json_decode($tmp))->first();
                $text = new Text($tmp->conf);
                $conf = Scope::fromString($text);
                $tmp->conf = $conf;
                return $tmp;
            } catch (\Exception $e) {
                throw $e;
            }
        } else {
            throw new \Exception('Impossible de récupérer les détails du vhosts');
        }
    }

    public static function edit($key, $conf){
        if(!$key){
            throw new \Exception('Pas de clé');
        }
        if(!$conf){
            throw new \Exception('Pas de configuration');
        }
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') ."/edit_vhost/";
        $client = new GuzzleHttp\Client();
        $request = [
            'form_params' => [
                'conf' => $conf,
                'vhost' => $key
            ]
        ];
        try{
            $res = $client->request('POST', $url, $request);
            return $res->getBody()->getContents();
        } catch (\Exception $e){
            return $e;
        }
    }

}