<?php

namespace App\Helpers;

use GuzzleHttp;

class FirewallHelper {

    /**
     * Retourne true si le firewall est actif. False sinon.
     */
    public static function getStatus(){
        return true;
    }

    public static function startCsf(){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') ."/start_csf";
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        } else {
            throw new \Exception('Impossible de récupérer les Vhosts');
        }
    }

    public static function shutdownCsf(){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') ."/shutdown_csf";
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        } else {
            throw new \Exception('Impossible de récupérer les Vhosts');
        }
    }

    public static function restartCsf(){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') ."/restart_csf";
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        } else {
            throw new \Exception('Impossible de récupérer les Vhosts');
        }
    }

    public static function getListe(){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') . "/list_csf_iptable";
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        } else {
            throw new \Exception('Impossible de récupérer la liste.');
        }
    }

    public static function rechercheIp($ip){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') . "/grep_csf_ip/" . $ip;
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        } else {
            throw new \Exception('Impossible de récupérer la liste.');
        }
    }

    public static function pingIps(){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') . "/ping_ip_csf";
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        } else {
            throw new \Exception('Impossible de faire le ping');
        }
    }

    public static function allowCsfIp($ip){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') . "/allow_csf_ip/" . $ip;
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        } else {
            throw new \Exception("Impossible d'ajouter l'IP");
        }
    }

    public static function removeCsfIp($ip){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') . "/remove_csf_ip/" . $ip;
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        } else {
            throw new \Exception("Impossible de supprimer l'IP");
        }
    }

    public static function denyCsfIp($ip){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') . "/deny_csf_ip/" . $ip;
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        } else {
            throw new \Exception("Impossible d'ajouter l'IP");
        }
    }

    public static function unlockCsfIp($ip){
        $client = new GuzzleHttp\Client();
        $url = "http://" . getenv('API_IP') . ":" . getenv('API_HOST') . "/unlock_csf_ip/" . $ip;
        $res = $client->get($url);
        if($res->getStatusCode() == 200){
            return $res->getBody()->getContents();
        } else {
            throw new \Exception("Impossible de supprimer l'IP");
        }
    }
}